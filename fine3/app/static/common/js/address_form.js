/**
 * auto formatting address form
 * require to include library static/common/js/jpostal.js
 * @autor shoyu
 */

$("#zip1").on('keyup',function(){if($("#zip1").val().length===3){$("#zip2").focus();}});$("#zip1").on('change',function(){$("#pref_default").addClass("display_none");}).jpostal({postcode:["#zip1","#zip2"],address:{"#address_pref":"%3","#address_city":"%4","#address_detail":"%5"}});$("#zip2").on('change',function(){ccs();});$("#zip2").on('keyup',function(){if($("#zip2").val().length===4){$("#address_detail").focus();}});$("#address_pref").on('change', function(){$("#pref_default").addClass("display_none");ccs();$("#address_city").val('')});function ccs(){console.log('ccs起動');var pref_id=$("option","#address_pref").eq($("#address_pref")[0].selectedIndex).data("pref_id");$("[class^=city_pref_id_]").addClass("display_none");$(".city_pref_id_"+pref_id).removeClass("display_none");}