$(document).ready(function () {
    //////////////////////////// Disable dropdown
    $('.items-select').attr('disabled',true);
    $('#account_id').change(function(){
        if($('#account_id').val()!='' && $('#account_id').val()!=undefined){
            $('.items-select').removeAttr('disabled');
            $('.items-select').trigger('change');
        }
        else{
            $('.items-select').attr('disabled',true);
        }
    });
    $('#account_id').trigger('change');
    
});