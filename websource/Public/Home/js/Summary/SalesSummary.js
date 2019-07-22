   function <?php echo $funcid; ?>_clear(_frm){
       setvaluebyname(frm,"t19:order_no", "" );
       setvaluebyname(frm,"t19:trade_no", "" );
       setvaluebyname(frm,"t19:order_time", "" );
       setvaluebyname(frm,"t19:order_time2", "" );
       setvaluebyname(frm,"t07:web_order_no", "" );
       setvaluebyname(frm,"t19:platform_id", "" );
       setvaluebyname(frm,"t03:shop_id_name", "" );
       setvaluebyname(frm,"t19:shop_id", "" );
       setvaluebyname(frm,"t21:storage_id_name", "" );
       setvaluebyname(frm,"t19:storage_id", "" );
       setvaluebyname(frm,"t19:buyer_nick", "" );
       setvaluebyname(frm,"t19:qty", "" );
       setvaluebyname(frm,"t19:qty2", "" );
       setvaluebyname(frm,"t19:amount", "" );
       setvaluebyname(frm,"t19:amount2", "" );
       setvaluebyname(frm,"t19:post_fee", "" );
       setvaluebyname(frm,"t19:post_fee2", "" );
       setvaluebyname(frm,"t19:weight", "" );
       setvaluebyname(frm,"t19:weight2", "" );
       setvaluebyname(frm,"t19:accept_name", "" );
       setvaluebyname(frm,"t19:telphone", "" );
       setvaluebyname(frm,"t19:mobile", "" );
       setvaluebyname(frm,"t19:address", "" );
       setvaluebyname(frm,"t43:country_name", "" );
       setvaluebyname(frm,"t19:country", "" );
       setvaluebyname(frm,"t43:province_name", "" );
       setvaluebyname(frm,"t19:province", "" );
       setvaluebyname(frm,"t43:city_name", "" );
       setvaluebyname(frm,"t19:city", "" );
       setvaluebyname(frm,"t43:area_name", "" );
       setvaluebyname(frm,"t19:area", "" );
       setvaluebyname(frm,"t43:street_name", "" );
       setvaluebyname(frm,"t19:street", "" );
       setvaluebyname(frm,"t19:remarks", "" );
       setvaluebyname(frm,"t19:storage_message", "" );
       setvaluebyname(frm,"t19:buyer_message", "" );
       setvaluebyname(frm,"t19:seller_message", "" );
       setvaluebyname(frm,"t19:payment_status", "" );
       setvaluebyname(frm,"t19:payment_type", "" );
       setvaluebyname(frm,"t19:payment_id", "" );
       setvaluebyname(frm,"t19:payment_time", "" );
       setvaluebyname(frm,"t19:payment_time2", "" );
       setvaluebyname(frm,"t19:invoice_status", "" );
       setvaluebyname(frm,"t19:invoice_title", "" );
       setvaluebyname(frm,"t19:invoice_content", "" );
       setvaluebyname(frm,"t19:deliver_status", "" );
       setvaluebyname(frm,"t19:deliver_time", "" );
       setvaluebyname(frm,"t19:deliver_time2", "" );
       setvaluebyname(frm,"t19:deliver_id", "" );
       setvaluebyname(frm,"t19:cancel_time", "" );
       setvaluebyname(frm,"t19:cancel_time2", "" );
       setvaluebyname(frm,"t19:cancel_status", "" );
       setvaluebyname(frm,"t19:notice_status", "" );
       setvaluebyname(frm,"t19:notice_time", "" );
       setvaluebyname(frm,"t19:notice_time2", "" );
       setvaluebyname(frm,"t19:confirm_time", "" );
       setvaluebyname(frm,"t19:confirm_time2", "" );
       setvaluebyname(frm,"t19:confirm_type", "" );
       setvaluebyname(frm,"t19:confirm_status", "" );
       setvaluebyname(frm,"t19:status", "" );
       setvaluebyname(frm,"t19:is_hangup", "" );
       setvaluebyname(frm,"t19:hangup_tag_id", "" );
       setvaluebyname(frm,"t19:hangup_time", "" );
       setvaluebyname(frm,"t19:hangup_time2", "" );
       setvaluebyname(frm,"t19:hangup_release_time", "" );
       setvaluebyname(frm,"t19:hangup_release_time2", "" );
       setvaluebyname(frm,"t19:create_time", "" );
       setvaluebyname(frm,"t19:create_time2", "" );
       setvaluebyname(frm,"t01:create_user_id_name", "" );
       setvaluebyname(frm,"t19:create_user_id", "" );
       setvaluebyname(frm,"t19:modify_time", "" );
       setvaluebyname(frm,"t19:modify_time2", "" );
       setvaluebyname(frm,"t01:modify_user_id_name", "" );
       setvaluebyname(frm,"t19:modify_user_id", "" );
   }
  /***************************************************************************************/
  /* 前台页面初始化                                                                      */
  /***************************************************************************************/
  function <?php echo $funcid; ?>_init(_id)
  {
      return ;
  }
  /***************************************************************************************/
  /* 后台返回   callback                                                                 */
  /***************************************************************************************/
  function <?php echo $funcid; ?>_callback(_json)
  {
      // 返回类型 _json.action
      // 返回数据 _json.data
      switch(_json.action)
      {
        default:
           alert("no code for callback action '" + _json.action + "'");
           break;
      }
      return ;
  }
  /***************************************************************************************/
  /* 用户自定义                                                                          */
  /***************************************************************************************/
