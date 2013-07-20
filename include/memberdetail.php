<?php session_start();
?>
<script>
    $(document).ready(function() {
        $('#viewDetail').hide();
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
</script>
<div id="container" class="container">
    <?php include_once 'view.php'; ?>
    <div><span></span></div>
    <?php include_once 'searchform.php'; ?>
    
    <div id="demo" >
        <table id="example" class="display" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th style="width: 50px">S.N.</th>
                    <th >Name</th>
                    <th style="width: 160px">Role Type</th>    
                    <th style="width: 150px">Account Type</th>
                    <th style="width: 150px">View Details</th>
                </tr>
            </thead>
            <tbody >
            </tbody>        
        </table>
    </div>
</div>