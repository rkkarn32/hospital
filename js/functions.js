$(document).ready(function(){
    
});

function HideSearchDiv(){
    $('#searchRecord').hide();
}
function ShowSearchDiv(){
    $('#searchRecord').show();
}

function ShowViewDetail(){
    $('#viewDetail').show();
}
function HideViewDetail(){
    $('#viewDetail').hide();
}
function HideEditDetail(){
    $('#editDetail').hide();
}
function ShowEditDetail(){
    $('#editDetail').show();
}
function ShowPermissions(){
    $('.permissionList').show();
}
function HidePermissions(){
    $('.permissionList').hide();
}
function ShowPatientDiv(){
    $('#inputForPatient').show();
}
function HidePatientDiv(){
    $('#inputForPatient').hide();
}


function validateInputForm()
{
    var nowdatetime = new Date();
    var month = nowdatetime.getMonth() + 1;
    var day = nowdatetime.getDate();
    var year = nowdatetime.getFullYear();
    var nowdate = year + "/" + month + "/" + day;
    var todayToDate = Date.parse(nowdate);
    var success=true;
    var x=$('#name').val();
    if (x==null || x=="")
    {
        $('#name').attr("class", "error");
        success = false;
    }
    else
        $('#name').attr("class", "");
    var x=$('#roleList').val();
    if (x==0)
    {
        $('#roleList').attr("class", "error");
        success = false;
    }
    else
        $('#roleList').attr("class", "");
    var x=$('#accountList').val();
    if (x==0)
    {
        $('#accountList').attr("class", "error");
        success = false;
    }
    else
        $('#accountList').attr("class", "");
    
    if($('#roleList').val()==3 && !($('#retrieveData').is(':checked') || $('#reportData').is(':checked')))
    {
        alert("Minimum one permission must be selected for LLA users");
        success = false;
    }
    
    var x= Date.parse($('#creationDate').val());
    if (x==null || x > nowdatetime)
    {
        $('#creationDate').attr("class", "error");
        success = false;
    }
    else
        $('#creationDate').attr("class", "");
    
    x=$('#birthDate').val();
    
    if(x==null || x=='')
    {
        $('#birthDate').attr("class", "error");
        success = false;
    }
    else
    {
        $('#birthDate').attr("class", "");
        var selectedBirthDate = Date.parse(x);
        if (x=='yyyy-mm-dd' || selectedBirthDate > todayToDate)
        {
            $('#birthDate').attr("class", "error");
            success = false;
        }
        else
            $('#birthDate').attr("class", "");
    }
    if(!success){
        $('#errorDisplay').html('*** Please !!! fill the highlighted areas correctly ***').show();
    }
    return success;
  
}

function validateEditForm()
{
    var nowdatetime = new Date();
    var month = nowdatetime.getMonth() + 1;
    var day = nowdatetime.getDate();
    var year = nowdatetime.getFullYear();
    var nowdate = year + "/" + month + "/" + day;
    var todayToDate = Date.parse(nowdate);
    var success=true;
    var x=$('#name_E').val();
    if (x==null || x=="")
    {
        $('#name_E').attr("class", "error");
        success = false;
    }
    else
        $('#name_E').attr("class", "");
    var x=$('#roleList').val();
    if (x==0)
    {
        $('#roleList').attr("class", "error");
        success = false;
    }
    else
        $('#roleList').attr("class", "");
    var x=$('#accountList').val();
    if (x==0)
    {
        $('#accountList').attr("class", "error");
        success = false;
    }
    else
        $('#accountList').attr("class", "");
    
    if($('#roleList').val()==3 && !($('#retrieveData').is(':checked') || $('#reportData').is(':checked')))
    {
        alert("Minimum one permission must be selected for LLA users");
        success = false;
    }
    
    var x= Date.parse($('#creationDate_E').val());
    if (x==null || x > nowdatetime)
    {
        $('#creationDate_E').attr("class", "error");
        success = false;
    }
    else
        $('#creationDate_E').attr("class", "");
    
    x=$('#birthDate_E').val();
    
    if(x==null || x=='')
    {
        $('#birthDate_E').attr("class", "error");
        success = false;
    }
    else
    {
        $('#birthDate_E').attr("class", "");
        var selectedBirthDate = Date.parse(x);
        if (x=='yyyy-mm-dd' || selectedBirthDate > todayToDate)
        {
            $('#birthDate_E').attr("class", "error");
            success = false;
        }
        else
            $('#birthDate_E').attr("class", "");
    }
    if(!success){
        $('#errorDisplay').html('*** Please !!! fill the highlighted areas correctly ***').show();
    }
    return success;
  
}

function RegisterUser(){
    if(!validateInputForm())
        return false;
    var Data = $('#userDetailForm').serialize();
    Data = "task=registeruser&"+Data;
    $.ajax({
        url:"taskprocess.php",
        data:Data,
        type:'POST',
        dataType:'json',
        cache:false,
        success: function(output){
            if(output[0] == true)
            {
                alert("Data entered successfully");
                window.location='index.php';
            }
            else
                alert("Problem occurs during Registration, Please try again! \nForm more detail see log file");
        },
        error:function(a,b,c){
            alert(a+", "+b+", "+c)
        }
    });
    return false;
}


function ShowUserDetails(id){
    var Data= "task=showuserdetail&id="+id;
    $.ajax({
        url:"taskprocess.php" ,
        data:Data,
        cache:false,
        dataType:'json',
        type:'POST',
        success: function(output){
            if(output[0] !=0){
                $('#viewDetail').show();
                $('#userID_Retrieve').html(id);
                $('#name').html(output[0]);
                $('#userName').html(output[1])
                $('#accountType').html(output[2]);
                if(output[3]==3)
                    $('#permissionDetail').show();
                else
                    $('#permissionDetail').hide();
                $('#accountGroup').html(output[4]);
                $('#creationDate').html(output[6]);
                $('#streetAddress').html(output[7]);
                $('#state').html(output[8]);
                $('#city').html(output[9]);
                $('#birthDate').html(output[10]);
                $('#phoneNumber').html(output[11]);
                if(output[12]==0){
                    $('#patientDetail').hide();
                }
                else{
                    $('#patientDetail').show();
                    $('#doctorName').html(output[12]);
                    $('#nurseName').html(output[14]);
                    $('#purposeOfVisit').html(output[16]);
                    $('#diagnosisGiven').html(output[17]);
                    $('#medicationPrescribed').html(output[18]);
                    $('#lastOfficeVisit').html(output[19]);
                }
                $('#editButton').attr('onclick',"EditUserDetails("+id+"); UpdatePermissionList("+id+")");
            }
        },
        error:function (a, b , c){
            alert(a+" "+" "+c);
        }
    });
    return false;
}

function EditUserDetails(id){
    HideEditDetail();
    $('#viewDetail').hide();
    var Data= "task=showuserdetail&id="+id;
    $.ajax({
        url:"taskprocess.php" ,
        data:Data,
        cache:false,
        dataType:'json',
        type:'POST',
        success: function(output){
            if(output[0] !=0){
                $('#editDetail').show();
                $('#userID_E').val(id);
                $('#name_E').val(output[0]);
                $('#userName_E').val(output[1])
                $('#roleList').val(output[3]);
                if(output[3]==3)
                    $('#permissionDetail_E').show();
                //loadPermissionList(3);
                //$('#accountList').val(output[5]);
                $('#creationDate_E').val(output[6]);
                $('#streetAddress_E').val(output[7]);
                $('#state_E').val(output[8]);
                $('#city_E').val(output[9]);
                $('#birthDate_E').val(output[10]);
                $('#phoneNumber_E').val(output[11]);
                if(output[12]==0){
                    $('#patientDetail_E').hide();
                }
                else{
                    $('#patientDetail_E').show();
                    $('#doctorName_E').val(output[13]);
                    $('#nurseName_E').val(output[15]);
                    $('#purposeOfVisit_E').val(output[16]);
                    $('#diagnosisGiven_E').val(output[17]);
                    $('#medicationPrescribed_E').val(output[18]);
                    $('#lastOfficeVisit_E').val(output[19]);
                }
            }
        },
        error:function (a, b , c){
            alert(a+" "+" "+c);
        }
    });
    return true;
}

function ShowLoading(message){
    var imagePath = + 'images/ajax-loader.gif';
    var loaderImageTag = '<img src="images/ajax-loader.gif" alt="" /><span>'+message+'</span>';
    $('#loading').html(loaderImageTag);
    $('#loading').show();
}
function EndLoading(){
    $('#loading').hide();
}
function Login(){
    var Data = $('#loginForm').serialize();
    Data = "task=login&"+Data;
    ShowLoading("Login is in process");
    $.ajax({
        url:'taskprocess.php',
        data:Data,
        type:"POST",
        cache:false,
        dataType:'json',
        success:function(output){
            EndLoading();
            if(output[0] == 1){
                if(output[1]==0)
                    window.location="modalmessage.php?name="+output[2];
                else
                {
                    window.location= "profile.php";
                }
            }else{
                alert('login Failure, Error: '+output[1]);
            }
        },
        error:function(a,b,c){
            EndLoading();
            alert(a,b,c);
        }
    });
    return false;
    
}

function loadPermissionList(){
    var roleList = $('#roleList').val();
    var accountList = "<option value='0' selected='selected'>Select Account</option>";
    if(roleList == 4){
        accountList += "<option value='3'>Patient</option>";
        HidePermissions();
        ShowPatientDiv();
    }
    else{
        HidePatientDiv();
        accountList += "<option value='1'>Doctor</option>"+"<option value='2'>Nurse</option>";
        if(roleList == 3)
            ShowPermissions();
        else
            HidePermissions();
    }
    $('#accountList').html(accountList);
}

function SearchRecord(){
    var Data = $('#searchForm').serialize();
    Data = 'task=searchRecord&'+Data;
    $.ajax({
        url:'taskprocess.php',
        data:Data,
        type:'POST',
        dataType:'json',
        cache:false,
        success:function(output){
            oTable.fnClearTable();
            if(output[0] !=0){                        
                for(var i =0; i < output.length;i++){
                    oTable.fnAddData([i+1,output[i][1],output[i][2],output[i][3],
                        "<button type='button' class='green-button' onclick='ShowUserDetails("+output[i][0]+");ShowPermissionList("+output[i][0]+")'>Show Details</button>",
                        "<button type='button' class='red-button' onclick='DeleteUser("+output[i][0]+");'>Delete User</button>"
                        ]);
                }
            }
        },
        error:function(a,b,c){
            alert(a+b+c);
        }
    });
    return false;
}

function ReportData(){
    var data = $('#reportForm').serialize();
    data = "task=searchRecord&"+data;
    $.ajax({
        url:'taskprocess.php',
        data:data,
        cache:false,
        type:'POST',
        dataType:'json',
        success:function(output){
            oTable.fnClearTable();
            if(output[0] !=0){
                for(var i =0; i < output.length;i++){
                    oTable.fnAddData([i+1,output[i][1],output[i][2],output[i][3],
                        "<button type='button' class='green-button' onclick=\"PrintData("+output[i][0]+"); ShowPermissionList("+output[i][0]+")\">Report Data</button>"
                        ]);
                }
            }
        },
        error:function(x,y,z){
            alert(x+y+z);
        }
    });
    return false;
}
function PrintData(id){
    var Data= "task=showuserdetail&id="+id;
    $.ajax({
        url:"taskprocess.php" ,
        data:Data,
        cache:false,
        dataType:'json',
        type:'POST',
        success: function(output){
            if(output[0] !=0){                
                $('#viewDetail').show();
                $('#userID_Retrieve').html(id);
                var argument = "name="+output[0];
                $('#name').html(output[0]);
                argument += "&username="+output[1];
                $('#userName').html(output[1])
                argument += "&accounttype="+output[2];
                $('#accountType').html(output[2]);
                argument += "&permissiondetail="+output[3];
                if(output[3] == 3)
                    $('#permissionDetail').show();
                else
                    $('#permissionDetail').hide();
                argument += "&accountgroup="+output[4];
                $('#accountGroup').html(output[4]);
                argument += "&creationdate="+output[6];
                $('#creationDate').html(output[6]);
                argument += "&streetaddress="+output[7];
                $('#streetAddress').html(output[7]);
                argument += "&state="+output[8];
                $('#state').html(output[8]);
                argument += "&city="+output[9];
                $('#city').html(output[9]);
                argument += "&birthdate="+output[10];
                $('#birthDate').html(output[10]);
                argument += "&phonenumber="+output[11];
                $('#phoneNumber').html(output[11]);
                argument += "&patientdetail="+output[12];
                if(output[12]==0){
                    $('#patientDetail').hide();
                }
                else{
                    $('#patientDetail').show();
                    $('#doctorName').html(output[12]);
                    argument += "&nursename="+output[14];
                    $('#nurseName').html(output[14]);
                    argument += "&purposeofvisit="+output[16];
                    $('#purposeOfVisit').html(output[16]);
                    argument += "&diagnosisgiven="+output[17];
                    $('#diagnosisGiven').html(output[17]);
                    argument += "&medicationprescribed="+output[18];
                    $('#medicationPrescribed').html(output[18]);
                    argument += "&lastofficevisit="+output[19];
                    $('#lastOfficeVisit').html(output[19]);
                }
                $('#isPrintable').html(1);
                $('#valueChange').val(2);
            }
        },
        error:function (a, b , c){
            alert(a+" "+" "+c);
        }
    });
    return false;
}

function PrintElem(elem)
{
    Popup($(elem).html());
}

function Popup(data) 
{
    var mywindow = window.open('', 'my div', 'height=400,width=600');
    mywindow.document.write('<html><head><title>Your details</title>');        
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');
    mywindow.print();
    mywindow.close();
    return true;
}
function CancelUpdate(){
    HideEditDetail();
    ShowViewDetail();
}
function UpdateRecord(){
    if( !validateEditForm())
        return false;
    var data = $('#editForm_E').serialize();
    var userID = $('#userID_E').val();
    data = "task=updateRecord&userId_E="+userID+"&"+data;
    $.ajax({
        url:'taskprocess.php',
        data:data,
        cache:false,
        dataType:'json',
        type:'POST',
        success:function(output){
            if(output[0] ==0){
                alert('Error Occure during Data update, Error: '+output[1]);
            }
            else{
                alert('User information Successfully Updated');
                window.location = "http://localhost/Hospital/userdetail.php";
            }
        },
        error:function(a,b,c){
            alert("Error, Data: "+a+", "+b+", "+c);
        }
    });
    return false;
}
function ShowPermissionList(userID){
    var data = "task=showpermissionlist&userid="+userID;
    $.ajax({
        url:'taskprocess.php' ,
        cache:false,
        dataType:'json',
        data:data,
        type:'POST',
        success:function(output){
            var permissionList="<table id='permissionTable' width='100%' border='1px'>";
            if(output[0] !=0)
            {
                for(var i = 0; i <output.length; i++){
                    if(i%2==0)
                        permissionList+="<tr>";
                    permissionList+= "<td>"+output[i][0]+"</td>";
                    if(i%2==1)
                        permissionList+="</tr>";
                }
            }else
                permissionList+= "<td align='center'>User doesn't have any special permissions";
            
            permissionList+="</table>";
            $('#permissionDetail').html(permissionList);
        }
    });
    return false;
}
function UpdatePermissionList(userID){
    var data = "task=showpermissionlist&userid="+userID;
    $.ajax({
        url:'taskprocess.php' ,
        cache:false,
        dataType:'json',
        data:data,
        type:'POST',
        success:function(output){
            var permissionList="<table id='permissionTable' width='100%' border='1px'>";
            if(output[0] !=0)
            {
                for(var i = 0; i <output.length; i++){
                    if(output[i][1]==1)
                        $('#reportData_E').attr("checked","checked");
                    if(output[i][1]==2)
                        $('#retrieveData_E').attr("checked","checked");
                }
            }
        }
    });
    return false;
}

function ChangeUsername(){
    if( $('#newUsername').val() == "")
    {
        alert("Username can't be Null");
        return false;
    }
    var data = $('#changeUsernameForm').serialize();
    data = "task=changeusername&"+data;
    $.ajax({
        url:'taskprocess.php' ,
        cache:false,
        dataType:'json',
        data:data,
        type:'POST',
        success:function(output){
            if(output[0] !=0)
            {
                alert('your UserName updated Successfully');
                window.location="profile.php";
            }
            else
                alert('Update Fail, Error: '+output[1]);
        },
        error:function(a,b,c){
            alert(a+b+c);
        }
    });
    return false;
}

function ChangePassword(){
    var newPassword= $('#newPassword').val();
    var confirmPassword= $('#confirmPassword').val();
    
    if(newPassword != confirmPassword ){
        alert('Password And Confirm Password Should be same');
        return false;
    }
    if(newPassword == "")
    {
        alert("Password Can't be null");
        return false;
    }
        
    
    var data = "task=changepassword&newPassword="+newPassword;
    $.ajax({
        url:'taskprocess.php' ,
        cache:false,
        dataType:'json',
        data:data,
        type:'POST',
        success:function(output){
            if(output[0] !=0)
            {
                alert('your Password Successfully updated');
                window.location="profile.php";
            }
            else
                alert('Update Fail, Error: '+output[1]);
        },
        error:function(a,b,c){
            alert(a+b+c);
        }
    });
    return false;
}

function LoadAllUser(){
    var Data = "task=loadalluser";
                $.ajax({
                    url:'taskprocess.php',
                    data:Data,
                    type:'POST',
                    dataType:'json',
                    cache:false,
                    success: function(output){
                        if(output[0][0] !=0){
                            oTable.fnClearTable();
                        
                            for(var i =0; i < output.length;i++){
                                oTable.fnAddData([i+1,output[i][1],output[i][2],output[i][3],
                                    "<button type='button' class='green-button' onclick='ShowUserDetails("+output[i][0]+"); ShowPermissionList("+output[i][0]+")'>Show Details</button>",
                                    "<button type='button' class='red-button' onclick='DeleteUser("+output[i][0]+");'>Delete User</button>"
                                ]);
                            }
                        }
                    },
                    error:function(a,b,c){
                        alert("Error is "+a+b+c);
                    }
                });
}


function DeleteUser(id){
    
    if (confirm('Are you sure you want to Remove the User')) {
        var data = "task=deleteuser&id="+id;
        $.ajax({
            url:'taskprocess.php' ,
            cache:false,
            dataType:'json',
            data:data,
            type:'POST',
            success:function(output){
                if(output[0] !=0)
                {
                    alert('User Deleted successfully');
                    LoadAllUser();
                }
                else
                    alert('Fail to remove user, Error: '+output[1]);
            },
            error:function(a,b,c){
                alert(a+b+c);
            }
        });
    }
    
    return false;
    
}