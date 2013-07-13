function check(){
var d_fname,d_mname,d_lname,d_citizenno,d_licenceno,d_zone,d_district,d_city,d_houseno,f_fname,f_mname,f_lname,f_relation,g_fname,g_mname,g_lname,g_relation,l_type,l_amount,l_validperiod,l_branch,c_type,c_cashvalue,c_weitage_amount;
var d_sex,f_sex,g_sex;
d_fname = document.forms["debtor_details"]["d_fname"].value;
if(d_fname == null || d_fname == ""){
alert("You must enter the debtor's full name");
return false;
}
}