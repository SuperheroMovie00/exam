/*!
 * ZRender, a high performance canvas library.
 *  
 * Copyright (c) 2013, Baidu Inc.
 * All rights reserved.
 * 
 * LICENSE
 * https://github.com/ecomfe/zrender/blob/master/LICENSE.txt
 */
define(
    function(require) {
        /*
         * HTML5 Canvas for Internet Explorer!
         * Modern browsers like Firefox, Safari, Chrome and Opera support
         * the HTML5 canvas tag to allow 2D command-based drawing.
         * ExplorerCanvas brings the same functionality to Internet Explorer.
         * To use, web developers only need to include a single script tag
         * in their existing web pages.
         *
         * https://code.google.com/p/explorercanvas/
         * http://explorercanvas.googlecode.com/svn/trunk/excanvas.js
         */
        // 核心代码会生成一个全局变量 G_vmlCanvasManager，模块改造后借用于快速判断canvas支持
        require('./dep/excanvas');

        var util = require('./tool/util');
        var log = require('./tool/log');
        var guid = require('./tool/guid');

        var Handler = require('./Handler');
        var Painter = require('./Painter');
        var Storage = require('./Storage');
        var Animation = require('./animation/Animation');

        var _instances = {};    // ZRender实例map索引

        /**
         * @exports zrender
         * @author Kener (@Kener-林峰, linzhifeng@baidu.com)
         *         pissang (https://www.github.com/pissang)
         */
        var zrender = {};
        /**
         * @type {string}
         */
        zrender.version = '2.0.2';

        /**
         * 创建zrender实例
         *
         * @param {HTMLElement} dom 绘图容器
         * @return {module:zrender~ZRender} ZRender实例
         */
        // 不让外部直接new ZRender实例，为啥？
        // 不为啥，提供全局可控同时减少全局污染和降低命名冲突的风险！
        zrender.init = function(dom) {
            var zr = new ZRender(guid(), dom);
            _instances[zr.id] = zr;
            return zr;
        };

        /**
         * zrender实例销毁
         * @param {module:zrender~ZRender} zr ZRender对象，不传则销毁全部
         */
        // 在_instances里的索引也会删除了
        // 管生就得管死，可以通过zrender.dispose(zr)销毁指定ZRender实例
        // 当然也可以直接zr.dispose()自己销毁
        zrender.dispose = function (zr) {
            if (zr) {
                zr.dispose();
            }
            else {
                for (var key in _instances) {
                    _instances[key].dispose();
                }
                _instances = {};
            }

            return zrender;
        };

        /**
         * 获取zrender实例
         * @param {string} id ZRender对象索引
         * @return {module:zrender~ZRender}
         */
        zrender.getInstance = function (id) {
            return _instances[id];
        };

        /**
         * 删除zrender实例，ZRender实例dispose时会调用，
         * 删除后getInstance则返回undefined
         * ps: 仅是删除，删除的实例不代表已经dispose了~~
         *     这是一个摆脱全局zrender.dispose()自动销毁的后门，
         *     take care of yourself~
         *
         * @param {string} id ZRender对象索引
         */
        zrender.delInstance = function (id) {
            delete _instances[id];
            return zrender;
        };

        function getFrameCallback(zrInstance) {
            return function () {
                var animatingShapes = zrInstance.animatingShapes;
                for (var i = 0, l = animatingShapes.length; i < l; i++) {
                    zrInstance.storage.mod(animatingShapes[i].id);
                }

                if (animatingShapes.length || zrInstance._needsRefreshNextFrame) {
                    zrInstance.refresh();
                }
            };
        }

        /**
         * ZRender接口类，对外可用的所有接口都在这里
         * 非get接口统一返回支持链式调用
         *
         * @constructor
         * @alias module:zrender~ZRender
         * @param {string} id 唯一标识
         * @param {HTMLElement} dom dom对象，不帮你做document.getElementById
         * @return {ZRender} ZRender实例
         */
        var ZRender = function(id, dom) {
            /**
             * 实例 id
             * @type {string}
             */
            this.id = id;
            this.env = require('./tool/env');

            this.storage = new Storage();
            this.painter = new Painter(dom, this.storage);
            this.handler = new Handler(dom, this.storage, this.painter);

            // 动画控制
            this.animatingShapes = [];
            /**
             * @type {module:zrender/animation/Animation}
             */
            this.animation = new Animation({
                stage : {
                    update : getFrameCallback(this)
                }
            });
            this.animation.start();

            this._needsRefreshNextFrame = false;
        };

        /**
         * 获取实例唯一标识
         * @return {string}
         */
        ZRender.prototype.getId = function () {
            return this.id;
        };

        /**
         * 添加图形形状到根节点
         * 
         * @param {module:zrender/shape/Base} shape 形状对象，可用属性全集，详见各shape
         */
        ZRender.prototype.addShape = function (shape) {
            this.storage.addRoot(shape);
            return this;
        };

        /**
         * 添加组到根节点
         *
         * @param {module:zrender/Group} group
         */
        ZRender.prototype.addGroup = function(group) {
            this.storage.addRoot(group);
            return this;
        };

        /**
         * 从根节点删除图形形状
         * 
         * @param {string} shapeId 形状对象唯一标识
         */
        ZRender.prototype.delShape = function (shapeId) {
            this.storage.delRoot(shapeId);
            return this;
        };

        /**
         * 从根节点删除组
         * 
         * @param {string} groupId
         */
        ZRender.prototype.delGroup = function (groupId) {
            this.storage.delRoot(groupId);
            return this;
        };

        /**
         * 修改图形形状
         * 
         * @param {string} shapeId 形状对象唯一标识
         * @param {Object} shape 形状对象
         */
        ZRender.prototype.modShape = function (shapeId, shape) {
            this.storage.mod(shapeId, shape);
            return this;
        };

        /**
         * 修改组
         * 
         * @param {string} groupId
         * @param {Object} group
         */
        ZRender.prototype.modGroup = function (groupId, group) {
            this.storage.mod(groupId, group);
            return this;
        };

        /**
         * 修改指定zlevel的绘制配置项
         * 
         * @param {string} zLevel
         * @param {Object} config 配置对象
         * @param {string} [config.clearColor=0] 每次清空画布的颜色
         * @param {string} [config.motionBlur=false] 是否开启动态模糊
         * @param {number} [config.lastFrameAlpha=0.7]
         *                 在开启动态模糊的时候使用，与上一帧混合的alpha值，值越大尾迹越明显
         * @param {Array.<number>} [config.position] 层的平移
         * @param {Array.<number>} [config.rotation] 层的旋转
         * @param {Array.<number>} [config.scale] 层的缩放
         * @param {boolean} [config.zoomable=false] 层是否支持鼠标缩放操作
         * @param {boolean} [config.panable=false] 层是否支持鼠标平移操作
         */
        ZRender.prototype.modLayer = function (zLevel, config) {
            this.painter.modLayer(zLevel, config);
            return this;
        };

        /**
         * 添加额外高亮层显示，仅提供添加方法，每次刷新后高亮层图形均被清空
         * 
         * @param {Object} shape 形状对象
         */
        ZRender.prototype.addHoverShape = function (shape) {
            this.storage.addHover(shape);
            return this;
        };

        /**
         * 渲染
         * 
         * @param {Function} callback  渲染结束后回调函数
         */
        ZRender.prototype.render = function (callback) {
            this.painter.render(callback);
            this._needsRefreshNextFrame = false;
            return this;
        };

        /**
         * 视图更新
         * 
         * @param {Function} callback  视图更新后回调函数
         */
        ZRender.prototype.refresh = function (callback) {
            this.painter.refresh(callback);
            this._needsRefreshNextFrame = false;
            return this;
        };

        /**
         * 标记视图在浏览器下一帧需要绘制
         */
        ZRender.prototype.refreshNextFrame = function() {
            this._needsRefreshNextFrame = true;
            return this;
        };
        
        /**
         * 绘制高亮层
         * @param {Function} callback  视图更新后回调函数
         */
        ZRender.prototype.refreshHover = function (callback) {
            this.painter.refreshHover(callback);
            return this;
        };

        /**
         * 视图更新
         * 
         * @param {Array.<module:zrender/shape/Base>} shapeList 需要更新的图形列表
         * @param {Function} callback  视图更新后回调函数
         */
        ZRender.prototype.refreshShapes = function (shapeList, callback) {
            this.painter.refreshShapes(shapeList, callback);
            return this;
        };

        /**
         * 调整视图大小
         */
        ZRender.prototype.resize = function() {
            this.painter.resize();
            return this;
        };

        /**
         * 动画
         * 
         * @param {string} shapeId 形状对象唯一标识
         * @param {string} path 需要添加动画的属性获取路径，可以通过a.b.c来获取深层的属性
         * @param {boolean} [loop] 动画是否循环
         * @return {module:zrender/animation/Animation~Animator}
         * @example:
         *     zr.animate(circle.id, 'style', false)
         *         .when(1000, {x: 10} )
         *         .done(function(){ // Animation done })
         *         .start()
         */
        ZRender.prototype.animate = function (shapeId, path, loop) {
            var shape = this.storage.get(shapeId);
            if (shape) {
                var target;
                if (path) {
                    var pathSplitted = path.split('.');
                    var prop = shape;
                    for (var i = 0, l = pathSplitted.length; i < l; i++) {
                        if (!prop) {
                            continue;
                        }
                        prop = prop[pathSplitted[i]];
                    }
                    if (prop) {
                        target = prop;
                    }
                }
                else {
                    target = shape;
                }

                if (!target) {
                    log(
                        'Property "'
                        + path
                        + '" is not existed in shape '
                        + shapeId
                    );
                    return;
                }

                var animatingShapes = this.animatingShapes;
                if (typeof shape.__aniCount === 'undefined') {
                    // 正在进行的动画记数
                    shape.__aniCount = 0;
                }
                if (shape.__aniCount === 0) {
                    animatingShapes.push(shape);
                }
                shape.__aniCount++;

                return this.animation.animate(target, { loop: loop })
                    .done(function () {
                        shape.__aniCount--;
                        if (shape.__aniCount === 0) {
                            // 从animatingShapes里移除
                            var idx = util.indexOf(animatingShapes, shape);
                            animatingShapes.splice(idx, 1);
                        }
                    });
            }
            else {
                log('Shape "' + shapeId + '" not existed');
            }
        };

        /**
         * 停止所有动画
         */
        ZRender.prototype.clearAnimation = function () {
            this.animation.clear();
        };

        /**
         * loading显示
         * 
         * @param {Object=} loadingEffect loading效果对象
         */
        ZRender.prototype.showLoading = function (loadingEffect) {
            this.painter.showLoading(loadingEffect);
            return this;
        };

        /**
         * loading结束
         */
        ZRender.prototype.hideLoading = function () {
            this.painter.hideLoading();
            return this;
        };

        /**
         * 获取视图宽度
         */
        ZRender.prototype.getWidth = function() {
            return this.painter.getWidth();
        };

        /**
         * 获取视图高度
         */
        ZRender.prototype.getHeight = function() {
            return this.painter.getHeight();
        };

        /**
         * 图像导出
         * @param {string} type
         * @param {string} [backgroundColor='#fff'] 背景色
         * @return {string} 图片的Base64 url
         */
        ZRender.prototype.toDataURL = function(type, backgroundColor, args) {
            return this.painter.toDataURL(type, backgroundColor, args);
        };

        /**
         * 将常规shape转成image shape
         * @param {module:zrender/shape/Base} e
         * @param {number} width
         * @param {number} height
         */
        ZRender.prototype.shapeToImage = function(e, width, height) {
            var id = guid();
            return this.painter.shapeToImage(id, e, width, height);
        };

        /**
         * 事件绑定
         * 
         * @param {string} eventName 事件名称
         * @param {Function} eventHandler 响应函数
         */
        ZRender.prototype.on = function(eventName, eventHandler) {
            this.handler.on(eventName, eventHandler);
            return this;
        };

        /**
         * 事件解绑定，参数为空则解绑所有自定义事件
         * 
         * @param {string} eventName 事件名称
         * @param {Function} eventHandler 响应函数
         */
        ZRender.prototype.un = function(eventName, eventHandler) {
            this.handler.un(eventName, eventHandler);
            return this;
        };
        
        /**
         * 事件触发
         * 
         * @param {string} eventName 事件名称，resize，hover，drag，etc
         * @param {event=} event event dom事件对象
         */
        ZRender.prototype.trigger = function (eventName, event) {
            this.handler.trigger(eventName, event);
            return this;
        };
        

        /**
         * 清除当前ZRender下所有类图的数据和显示，clear后MVC和已绑定事件均还存在在，ZRender可用
         */
        ZRender.prototype.clear = function () {
            this.storage.delRoot();
            this.painter.clear();
            return this;
        };

        /**
         * 释放当前ZR实例（删除包括dom，数据、显示和事件绑定），dispose后ZR不可用
         */
        ZRender.prototype.dispose = function () {
            this.animation.stop();
            
            this.clear();
            this.storage.dispose();
            this.painter.dispose();
            this.handler.dispose();

            this.animation = 
            this.animatingShapes = 
            this.storage = 
            this.painter = 
            this.handler = null;

            // 释放后告诉全局删除对自己的索引，没想到啥好方法
            zrender.delInstance(this.id);
        };

        return zrender;
    }
);
