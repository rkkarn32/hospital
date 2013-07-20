
$(document).ready(function(){
    $('#viewDetail').hide();
    $(document).ready(function() {
        oTable = $('#example').dataTable({
            });
            
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
                            "<button type='button' onclick='ShowUserDetails("+output[i][0]+")'>Show Details</button>"
                            ]);
                    }
                }
            }
        });
    });
});

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
    
    var x= Date.parse($('#creationDate').val());
    if (x==null || x > nowdatetime)
    {
        alert("Creation date should not exceed today");
        return false;
    }
    
    x=$('#birthDate').val();
    
    if(x==null || x=='')
        alert ('please enter Date of Birth');
    
    var selectedBirthDate = Date.parse(x);
    if (x=='yyyy-mm-dd' || selectedBirthDate > todayToDate)
    {
        alert("Invalid Birth Date");
        return false;
    }
    
    return false;
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
            //            alert(output);
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
                    alert('First Login, huh !!');
            }else{
                alert('login Failure');
            }
        }
    });
    return false;
    
}

function ShowHidePatient(){
    var selectionID = $('#roleList').val();
    if(selectionID ==4 || selectionID==0 )
        $('#inputForPatient').show();
    else
        $('#inputForPatient').hide();
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