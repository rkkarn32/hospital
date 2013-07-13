
$(document).ready(function(){
    
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

function RegisterUser(){
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
                    window.location='index.php?action=profile';
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
    alert("Your ID: "+id);
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
            if(output == 1){
                
                window.location.href= "index.php";          //Reload the page
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