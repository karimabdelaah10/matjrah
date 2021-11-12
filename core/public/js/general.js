$(document).ready(function () {
    $('#master').on('click', function(e) {
        if($(this).is(':checked',true)){
         $(".sub_chk").prop('checked', true);  
        } else {  
         $(".sub_chk").prop('checked',false);  
        }  
    });
    $('.sub_chk').on('click', function(e) {
        var numberOfChecked = $('.sub_chk:checked').length;

        if(numberOfChecked > 0){
         $("#master").prop('checked', true);  
        } else {  
         $("#master").prop('checked',false);  
        }  
    });
    $('.delete_all').on('click', function(e) {
        var ids = [];  
        $(".sub_chk:checked").each(function() {  
            ids.push($(this).attr('data-id'));
        }); 
        if(ids.length > 0)  {
            var title = $(this).data("title");
            if (!$('#dataConfirmModal').length) {
              $('body').append('  <div class="modal fade" id="dataConfirmModal" tabindex="-1" role="document">\n\
                                 <div class="modal-dialog modal-sm" role="document">\n\
                                  <div class="modal-content bd-0">\n\
                                    <div class="modal-body tx-center pd-y-20 pd-x-20">\n\
                                      Hi I am a Modal Example for Dashio Admin Panel.\n\
                                    </div>\n\
                                    <div class="modal-footer justify-content-center">\n\
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>\n\
                                      <a class="btn btn-success" id="dataConfirmOK">Yes</a>\n\
                                    </div>\n\
                                  </div>\n\
                                </div>\n\
                              </div> ');
            }
            var url = $(this).data('url') +'?ids='+ids;
            $('#dataConfirmModal').find('.modal-body').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>' + $(this).attr('data-confirm'));
            $('#dataConfirmOK').attr('href', url);
            $('#dataConfirmModal').modal({show: true});
            return false;   
        }else{
          $(".alert").addClass('alert-danger').text($(this).data('no-row')).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );   
        } 
      
    });
});