function loadProductsOfSubStages(id){
    d = new Date();
    u = "http://localhost/builders/extra/selectproductsofsubstages/" + id + "/" + d.getTime();
    //alert(u);
    $("#productitem").load(u); 
    
}

function preViewImage(input, tag_id) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#' + tag_id).attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

function updatePackagesProducts(companyid){
     d = new Date();
    u = "http://localhost/builders/extra/selectspackagesproducts/" + companyid + "/" + d.getTime();
    //alert(u);
    $("#packagesproducts").load(u);
    
}


function updateStageSubCategory(prodid){
  
    d = new Date();
    u = "http://localhost/builders/extra/selectstagesubcategory/" + prodid + "/" + d.getTime();
    //alert(u);
    $("#prosubcategory").load(u); 
    
}


function updateSubCategory(id)
{
    
    d = new Date();
    u = "http://localhost/builders/extra/selectsubcategory/" + id + "/" + d.getTime();
    //alert(u);
    $("#subcategory").load(u);
}

function updateSubCategoryProduct(id)
{
    d = new Date();
    u = "http://localhost/builders/products/selectsubcategory/"+id+"/"+d.getTime();
    //alert(u);
    $("#subcategory").load(u);
}

function updateDesignSubCategory(id)
{
    d = new Date();
    u = "http://localhost/builders/setting/selectsubcategory/"+id+"/"+d.getTime();
    //alert(u);
    $("#subcategory").load(u);
}

function updateCompanyList()
{
    d = new Date();
    var id = $("#fk_category").val();
    u = "http://localhost/builders/invoices/updateCompanyList/"+id+"/"+d.getTime();
    //alert(u);
    $("#fk_company").load(u);
}

function updateSubCategoryInTeam()
{
    d = new Date();
    var id = $("#fk_category").val();
    u = "http://localhost/builders/teams/updateSubCategoryList/"+id+"/"+d.getTime();
    $("#fk_subcategory").load(u);
}

function updateDesignUrl(url, id)
{
    $("#design_url").val("designs/"+url+"/"+id);
}

function updateSettingDesignUrl(id)
{
    var url = $("#fk_category").val();
    $("#design_url").val("designs/"+url+"/"+id);
}

/*function productsFilterByCompany()
{
    d = new Date();
    var id = $("#fk_company").val();
    $.ajax({
        url : "http://localhost/builders/products/filterByCompany",
        type : "POST",
        dataType : "json",
        data : {"filter_companyid" : id},
        success : function(data) {
           true;
        },
        error : function(data) {
            alert("Please make sure your internet connection.");
        }
    });
}
*/

function productsFilter()
{
    d = new Date();
    var fk_company = $("#fk_company").val();
    var fk_product = $("#fk_product").val();
    var fk_category = $("#fk_category").val();
    var fk_subcategory = $("#fk_subcategory").val();
    location.href = "http://localhost/builders/products/productfilter/"+fk_company+"/"+fk_product+"/"+fk_category+"/"+fk_subcategory+"/"+d.getTime();
}

function invoicesFilter()
{
    d = new Date();
    var fk_company = $("#fk_company").val();
    var fk_project = $("#fk_project").val();
    location.href = "http://localhost/builders/invoices/filter/"+fk_company+"/"+fk_project+"/"+d.getTime();
}

function openedInvoicesFilter()
{
    d = new Date();
    var fk_company = $("#fk_company").val();
    var fk_project = $("#fk_project").val();
    location.href = "http://localhost/builders/invoices/openedFilter/"+fk_company+"/"+fk_project+"/"+d.getTime();
}

function closedInvoicesFilter()
{
    d = new Date();
    var fk_company = $("#fk_company").val();
    var fk_project = $("#fk_project").val();
    location.href = "http://localhost/builders/invoices/closedFilter/"+fk_company+"/"+fk_project+"/"+d.getTime();
}

function paymentsFilter()
{
    d = new Date();
    var fk_project = $("#fk_project").val();
    var fk_company = $("#fk_company").val();
    var fk_category = $("#fk_category").val();
    location.href = "http://localhost/builders/payments/filter/"+fk_project+"/"+fk_company+"/"+fk_category+"/"+d.getTime();
}

function creditPaymentsFilterByProject()
{
    d = new Date();
    var id = $("#fk_project").val();
    location.href = "http://localhost/builders/payments/creditPaymentsfilterByProject/"+id+"/"+d.getTime();
}

function asignPaymentsFilter()
{
    d = new Date();
    var fk_project = $("#fk_project").val();
    var fk_team = $("#fk_team").val();
    location.href = "http://localhost/builders/payments/asignPaymentsFilter/"+fk_project+"/"+fk_team+"/"+d.getTime();
}

function labourPaymentsFilter()
{
    d = new Date();
    var fk_project = $("#fk_project").val();
    var fk_team = $("#fk_team").val();
    location.href = "http://localhost/builders/payments/labourPaymentsfilter/"+fk_project+"/"+fk_team+"/"+d.getTime();
}

function updateSocitiesList(id2)
{
    
    d2 = new Date();
    u2 = "http://localhost/builders/extra/selectsocieties/" + id2 + "/" + d2.getTime();
    //alert(u2);
    $("#societies").load(u2);
}

function updateReqCate(id3)
{
    
    d2 = new Date();
    u2 = "http://localhost/builders/extra/selectreqcatestatus/" + id3 + "/" + d2.getTime();
    //alert(u2);
    $("#statuscate").load(u2);
}

function projectModal(id) {

    var modalContent = "";
    $.ajax({
        url : "projects/ajaxGetProject",
        type : "POST",
        dataType : "json",
        data : {"id" : id},
        success : function(data) {
           modalContent ='<div class="card-header ">' + data['value']['name_project'] + '</div>';
           modalContent += '<img class="card-img-top img-thumbnail" src="' + data['value']['images_project'] + '" alt="Project image">';
            modalContent += '<div class="card-body">';
                modalContent += '<div class="row">';
                    modalContent += '<div class="col-md-7 housedetalis">';
                        modalContent += '<div class="housestatus">Name :     <span class="text-success text-uppercase font-weight-bold font-xs text-center"><b>' + data['value']['name_project'] + '</b></span>';  
                        modalContent += '</div>';
                        modalContent += '<div class="housestatus">Address :     <span class="text-muted text-uppercase font-weight-bold font-xs text-center"><b>' + data['value']['address_project'] + '</b></span>';  
                        modalContent += '</div>';
                        modalContent += '<div class="housestatus">Status :     <span class="text-warning text-uppercase font-weight-bold font-xs text-center"><b>Under Construction !</b></span>';  
                        modalContent += '</div>';
                        modalContent += '<div class="housestatus">Budget :  <span class="text-muted text-uppercase font-weight-bold font-xs text-center"><b>9500000 Pkr</b></span>';  
                        modalContent += '</div>';
                       modalContent += '<div class="housestatus">Client Paid :  <span class="text-success text-uppercase font-weight-bold font-xs text-center"><b>3000000 Pkr</b></span>';  
                        modalContent += '</div>';
                        modalContent += '<div class="housestatus">Total Cost :  <span class="text-primary text-uppercase font-weight-bold font-xs text-center"><b>3000000 Pkr</b></span>';  
                        modalContent += '</div>';
                        modalContent += '<div class="housestatus">Balance :  <span class="text-danger text-uppercase font-weight-bold font-xs text-center"><b>1000000 Pkr</b></span>';  
                        modalContent += '</div>';
                    modalContent += '</div>';
                    modalContent += '<div class="col-md-5 housedetalis">';
                        modalContent += '<div class="housestatus">';
                            modalContent += '<i class="fas fa-clock right text-success"><span class="text-success"> ' + data['value']['start_date'] + '</span></i>'; 
                        modalContent += '</div>';
                        modalContent += '<div class="housestatus">';
                            modalContent += '<i class="fas fa-hourglass-end right text-danger"><span class="text-danger"> ' + data['value']['end_date'] + '</span></i>';  
                        modalContent += '</div>';
                        modalContent += '<div class="housestatus">';
                            modalContent += '<i class="fas fa-clock right text-success"><span class="text-success" style="font-size: 13px;"> 10-06-2019 - 10 M 23 D</span></i>'; 
                        modalContent += '</div>';
                        modalContent += '<div class="housestatus">';
                            modalContent += '<i class="fas fa-hourglass-end right text-danger"><span class="text-danger" style="font-size: 13px;"> 10-06-2019 - 10 M 23 D</span></i>';  
                        modalContent += '</div>';
                        
                        modalContent += '<div class="housestatus">';
                            modalContent += '<i class="fas fa-file-invoice text-muted"></i> <span class="text-muted text-uppercase font-weight-bold font-xs text-right">Unpaid Invoices - </span> <span class="text-danger font-weight-bold font-xs">9</span>';  
                        modalContent += '</div>';
                        modalContent += '<div class="housestatus">';
                            modalContent += '<i class="fas fa-user text-muted"></i> <span class="text-muted text-uppercase font-weight-bold font-xs text-right">Client Tickets - </span> <span class="text-danger font-weight-bold font-xs">9</span>';  
                        modalContent += '</div>';
                       modalContent += '<div class="housestatus">';
                            modalContent += '<i class="fab fa-algolia text-muted"></i> <span class="text-muted text-uppercase font-weight-bold font-xs text-right">Alerts - </span> <span class="text-danger font-weight-bold font-xs">9</span>';  
                        modalContent += '</div>';
                    modalContent += '</div>';
                modalContent += '</div';   
            modalContent += '</div>';

            $('#projectModalContent').html(modalContent);
            $("#viewProjectModal").modal('show');
        },
        error : function(data) {
            alert("Please make sure your internet connection.");
        }
    });

}

function designModal(title, image_url, icon_class){
    var title = title;
    var image_view = '<img src="' + image_url + '" style="width: 100%;">';
    var image_title = '<i class="'+ icon_class +'"></i> ' + title;
    $('#image_view').html(image_view);
    $('#image_title').html(image_title);
    $("#viewDesignImageModal").modal('show');

}

function projectJoinClient(project_id, client_id)
{
    $("#join_result").css("display","none");
    d = new Date();
    $.ajax({
        url : "http://localhost/builders/projects/joinClient",
        type : "POST",
        dataType : "json",
        data : {"joined_clientid" : client_id, "project_id" : project_id},
        success : function(data) {
            if(client_id != 0){
                $("#join_result").css("display","block");                
            }
        },
        error : function(data) {
            alert("Please make sure your internet connection.");
        }
    });
}


$(document).ready(function() {
    $('#clienttable').DataTable( {
        "order": [[ 0, "desc" ]]
    } );

    $('.datepicker').datepicker({
        autoclose: true,
    });

   $("#start_date_credit").on('change', function(){
        var filter_date = $("#start_date_credit").val();
        if(filter_date !== "0"){
            var mtime = new Date(filter_date).getTime()/1000;
            location.href = "http://localhost/builders/payments/creditPaymentsFilterByDate/" + mtime;
        }
    });


   $("#start_date_asign").on('change', function(){
        var filter_date = $("#start_date_asign").val();
        if(filter_date !== "0"){
            var mtime = new Date(filter_date).getTime()/1000;
            location.href = "http://localhost/builders/payments/asignPaymentsFilterByDate/" + mtime;
        }
    });

   $("#start_date_labour").on('change', function(){
        var filter_date = $("#start_date_labour").val();
        if(filter_date !== "0"){
            var mtime = new Date(filter_date).getTime()/1000;
            location.href = "http://localhost/builders/payments/labourPaymentsFilterByDate/" + mtime;
        }
    });

/*    $("#add_project").on('change', function(){
        if($("#add_project").val() !== "0"){
            $.ajax({
                url : "ajaxGetProject",
                type : "POST",
                dataType : "json",
                data : {"id" : $("#add_project").val()},
                success : function(data) {
                    $('#preview_project_useradd').attr('src', '../' + data['value']['images_project']);
                },
                error : function(data) {
                    alert("Please make sure your internet connection.");
                }
            });
        }
    });

    $("#edit_project").on('change', function(){
        if($("#edit_project").val() !== "0"){
            $.ajax({
                url : "../ajaxGetProject",
                type : "POST",
                dataType : "json",
                data : {"id" : $("#edit_project").val()},
                success : function(data) {
                    $('#preview_project_useredit').attr('src', '../../' + data['value']['images_project']);
                },
                error : function(data) {
                    alert("Please make sure your internet connection.");
                }
            });
        }
    });

    if($("#edit_project").length > 0){
        if($("#edit_project").val() !== "0"){
            $.ajax({
                url : "../ajaxGetProject",
                type : "POST",
                dataType : "json",
                data : {"id" : $("#edit_project").val()},
                success : function(data) {
                    $('#preview_project_useredit').attr('src', '../../' + data['value']['images_project']);
                },
                error : function(data) {
                    alert("Please make sure your internet connection.");
                }
            });
        }
    }
*/
    $("#add_role").on('change', function(){
        if($("#add_role").val() == 'client'){
            $("#add_project").attr('disabled', false);
        }else if($("#add_role").val() !== 'client' || $("#add_role").val() == "0"){
            $("#add_project").val("0");
            $("#add_project").attr('disabled', true);
        }
    });

    $("#edit_role").on('change', function(){
        if($("#edit_role").val() == 'client'){
            $("#edit_project").attr('disabled', false);
        }else if($("#edit_role").val() !== 'client' || $("#edit_role").val() == "0"){
            $("#edit_project").val("0");
            $("#edit_project").attr('disabled', true);
        }
    });

} );




