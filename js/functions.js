$(document).ready(function(){
    HideEditDetail();
    oTable = $('#example').dataTable({
        });
});

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


function validateForm()
{
    var nowdatetime = new Date();
    var month = nowdatetime.getMonth() + 1;
    var day = nowdatetime.getDate();
    var year = nowdatetime.getFullYear();
    var nowdate = year + "/" + month + "/" + day;
    var todayToDate = Date.parse(nowdate);
    
    var x=$('#name').val();
    if (x==null || x=="")
    {
        alert("Name must be filled out");
        return false;
    }
    var x=$('#roleList').val();
    if (x==0)
    {
        alert("Please select account Type");
        return false;
    }
    var x=$('#accountList').val();
    if (x==0)
    {
        alert("Please select account Group");
        return false;
    }

    if($('#roleList').val()==3 && !($('#retrieveData').attr('checked') || $('#reportData').attr('checked')))
    {
        alert("Minimum one permission must be selected for LLA users");
        return false;
    }
    
    var x= Date.parse($('#creationDate').val());
    if (x==null || x > nowdatetime)
    {
        alert("Creation date should not exceed today");
        return false;
    }
    
    x=$('#birthDate').val();
    
    if(x==null || x=='')
    {
        alert ('please enter Date of Birth');
        return false;
    }
    
    var selectedBirthDate = Date.parse(x);
    if (x=='yyyy-mm-dd' || selectedBirthDate > todayToDate)
    {
        alert("Invalid Birth Date");
        return false;
    }
    return true;
  
}

function RegisterUser(){
    if(!validateForm())
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
            //                        alert(output);
            if(output[0] == true)
            {
                alert("Data entered successfully");
                window.location='index.php?action=memberdetail';
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
                $('#accountGroup').html(output[5]);
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
                    $('#nurseName').html(output[13]);
                    $('#purposeOfVisit').html(output[14]);
                    $('#diagnosisGiven').html(output[15]);
                    $('#medicationPrescribed').html(output[16]);
                    $('#lastOfficeVisit').html(output[17]);
                }
                $('#editButton').attr('onclick',"EditUserDetails("+id+")");
            }
        },
        error:function (a, b , c){
            alert(a+" "+" "+c);
        }
    });
    return false;
}

function EditUserDetails(id){
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
                $('#roleList').val(3);
                loadPermissionList(3);
                $('#accountList').val(output[4]);
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
                    $('#doctorName_E').val(output[12]);
                    $('#nurseName_E').val(output[13]);
                    $('#purposeOfVisit_E').val(output[14]);
                    $('#diagnosisGiven_E').val(output[15]);
                    $('#medicationPrescribed_E').val(output[16]);
                    $('#lastOfficeVisit_E').val(output[17]);
                }
            }
        },
        error:function (a, b , c){
            alert(a+" "+" "+c);
        }
    });
    return true;
}

function Login(){
    var Data = $('#loginForm').serialize();
    Data = "task=login&"+Data;
    $.ajax({
        url:'taskprocess.php',
        data:Data,
        type:"POST",
        cache:false,
        dataType:'json',
        success:function(output){
            if(output[0] == 1){
                window.location.href= "index.php";          //Reload the page
                if(output[1]==0)
                    alert('Welcome '+output[2]+'\nIts your First Login, Please Update your username and password is recommeded');
            }else{
                alert('login Failure');
            }
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
        cache: false,
        success:function(output){
            oTable.fnClearTable();
            if(output[0] !=0){                        
                for(var i =0; i < output.length;i++){
                    oTable.fnAddData([i+1,output[i][1],output[i][2],output[i][3],
                        "<button type='button' onclick='ShowUserDetails("+output[i][0]+")'>Show Details</button>"
                        ]);
                }
            }
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
            //alert (output);
            
            oTable.fnClearTable();
            //            alert (output);
            if(output[0] !=0){
                for(var i =0; i < output.length;i++){
                    oTable.fnAddData([i+1,output[i][1],output[i][2],output[i][3],
                        "<button type='button' onclick=\"PrintData("+output[i][0]+");\">Report Data</button>"
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
                $('#name').html(output[0]);
                $('#userName').html(output[1])
                $('#accountType').html(output[2]);
                $('#accountGroup').html(output[3]);
                $('#creationDate').html(output[4]);
                $('#streetAddress').html(output[5]);
                $('#state').html(output[6]);
                $('#city').html(output[7]);
                $('#birthDate').html(output[8]);
                $('#phoneNumber').html(output[9]);
                if(output[10]==0){
                    $('#patientDetail').hide();
                }
                else{
                    $('#patientDetail').show();
                    $('#doctorName').html(output[10]);
                    $('#nurseName').html(output[11]);
                    $('#purposeOfVisit').html(output[12]);
                    $('#diagnosisGiven').html(output[13]);
                    $('#medicationPrescribed').html(output[14]);
                    $('#lastOfficeVisit').html(output[15]);
                }
            }
        },
        error:function (a, b , c){
            alert(a+" "+" "+c);
        }
    });
//    alert($('#userName').html());
    //PrintElem('#userDetail');
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
    var data = $('#editForm_E').serialize();
//    alert(data);
    data = "task=updateRecord&"+data;
    $.ajax({
        url:'taskprocess.php',
        data:data,
        cache:false,
        dataType:'json',
        type:'POST',
        success:function(output){
            alert(output);
            if(output[0] ==0){
                alert('Error Occure during Data update, Error: '+output[1]);
            }
            else{
                alert('User information Successfully Updated');
            }
        }
    });
    return false;
}