
$('select#birth_year').change(function(){$("#birth_year_default").addClass("display_none");date_formatting("#birth_year","#birth_month","#birth_day");});
$('select#birth_month').change(function(){$("#birth_month_default").addClass("display_none");date_formatting("#birth_year","#birth_month","#birth_day");});

function date_formatting(df_year,df_month,df_day){
    var birth_year = $(df_year).val();
    var birth_month = $(df_month).val();
    if(birth_year !== ""&&birth_month !== ""){
        $(df_day).empty();
        if (2 == birth_month && (0 == birth_year % 400 || (0 == birth_year % 4 && 0 != birth_year % 100))) {
          var last = 29;
        }else{
          var last = new Array(31,28,31,30,31,30,31,31,30,31,30,31)[birth_month-1];
        }
        for (var i = 1; i <= last; i++){
            $(df_day).append('<option value="'+i+'">'+i+'</option>');
        }
    }
}