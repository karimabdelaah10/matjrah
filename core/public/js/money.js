var i = 1;
$(document).ready(function () {
    restRowsCount();
    //////////////////////////// Disable dropdown
    $("#is_recurring").change(function () {
        var is_recurring = $(this).val();
        if (is_recurring != '' && is_recurring != undefined && is_recurring == 1) {
            $('.recurring').removeClass('d-none ');
        } else {
            $('.recurring').addClass('d-none ');
        }
    });
    $("#is_recurring").trigger('change');
    $('#button-add-item').click(function () {
        $('.items-select').select2('destroy');
        var btnDelete = '<a class="btn btn-xs btn-danger row-delete" href="javascript:;" onclick="jQuery(this).parent().parent().remove();restRowsCount()"><i class="fa fa-trash" aria-hidden="true"></i></a>';
        var clonedRow = $('tbody tr:first').clone();
        clonedRow.find('input').val('');
        clonedRow.find('input[type=number]').val(0);
        clonedRow.find('textarea').val('');
        clonedRow.find('select').val('');
        clonedRow.find('.quantity').val('1');
        clonedRow.find('td:first-child').html(btnDelete);
        $('#addItem').before(clonedRow);
        $('.items-select').select2();
        i++;
        restRowsCount();
    });

    $("body").on('change', '.items-select', function () {
        var defaultCurrency = $('#account_id').find(":selected").attr('data-currency');
        if (defaultCurrency == '' || defaultCurrency == undefined) {
            defaultCurrency = 1;
        }
        var itemPrice = $(this).find(":selected").attr('data-price-' + defaultCurrency);
      
        var itemTax = $(this).find(":selected").attr('data-tax');
        $(this).closest('tr').find('.unitprice').val(itemPrice);
        $(this).closest('tr').find('.tax').val(itemTax);
    });
    // $("body").on('change', '.tax', function () {
    //     $(this).closest('td').find("input.tax_value").val(0);

    // });
    $("body").on('change', '.items', function () {
        $(this).closest('tr').find("input.tax_value").val(0);
        calc();

    });

});
function restRowsCount() {
    count = 0;
    $('.items-row').each(function (i, element) {
        $(this).attr('id', 'item-row-' + i);
        count++;
    });
    i = count;
    calc();
    renumber_inputs_name();
}
function calc()
{
    $('#total_discount').val(0);
    $('#discount-total').text(0);
    $('#sub_total').text(0);
    $('#sub_total_val').val(0);
    $('#total_tax').val(0);
    $('#tax-total').text(0);
    $('#grand_total_val').val(0);
    $('#grand_total').text(0);
    var total_tax = 0;
    var total_discount = 0;
    var total = 0;
    var grand_total = 0;
    var sub_total = 0;
    var sub_total_per_row = 0;
    var total_row = 0;
    var discount_row = 0;
    var tax_row = 0;
    $('#items tbody tr.items-row').each(function (i, element) {
        var html = $(this).html();
        if (html != '') {
            var qty = ($(this).find('.quantity').val()) ? $(this).find('.quantity').val() : 0;
            var price = ($(this).find('.unitprice').val()) ? $(this).find('.unitprice').val() : 0;
            var tax = ($(this).find("select.tax option:selected").data('percentage')) ? $(this).find("select.tax option:selected").data('percentage') : 0;
            var discount = ($(this).find('.discount').val()) ? $(this).find('.discount').val() : 0;
            var old_tax = ($(this).find('.tax_value').val()) ? $(this).find('.tax_value').val() : 0;
            sub_total_per_row = 0;
            total_row = 0;
            discount_row = 0;
            tax_row = 0;
            sub_total_per_row = qty * price;
            sub_total_per_row = parseFloat(sub_total_per_row.toFixed(2));
            // Calculate discount
            if (discount == null && discount == undefined) {
                discount = parseFloat(0);
            }
            discount_row = (sub_total_per_row * (discount / 100));
            discount_row = parseFloat(discount_row.toFixed(2));
            total_discount = parseFloat(total_discount) + parseFloat(discount_row);
            $(this).find('.discount_value').val(discount_row);
            // Calculate tax
            if (tax == null && tax == undefined) {
                tax = 0;
            }
            if (old_tax != 0) {
                tax_row = parseFloat(old_tax);
            } else {
                tax_row = parseFloat((sub_total_per_row-discount_row)/ 100 * tax);
            }
            tax_row = parseFloat(tax_row.toFixed(2));
            total_tax = parseFloat(total_tax) + parseFloat(tax_row);            
            //// Calculate total row
            total_row = parseFloat(sub_total_per_row) - parseFloat(discount_row) + parseFloat(tax_row);
            console.log('qty: '+qty);
            console.log('price: '+price);
            console.log('sub_total_per_row: '+sub_total_per_row);
            console.log('discount_row:' + discount_row);
            console.log('tax_row:' + tax_row);
            console.log('total_row: '+total_row);
            console.log('total_tax: '+total_tax);
            sub_total = parseFloat(sub_total) + parseFloat(sub_total_per_row);
            sub_total = parseFloat(sub_total).toFixed(2);
            $(this).find('.tax_value').val(tax_row);
        }
        total_tax = parseFloat(total_tax).toFixed(2);
        $('#total_tax').val(total_tax);
        $('#tax-total').text(total_tax);
        
        total_discount = parseFloat(total_discount).toFixed(2);
        $('#total_discount').val(total_discount);
        $('#discount-total').text(total_discount);
        
        sub_total = parseFloat(sub_total).toFixed(2);
        $('#sub_total').text(sub_total);
        $('#sub_total_val').val(sub_total);

        total_row = parseFloat(total_row).toFixed(2);
        $(this).find('.item_total').val(total_row);
        
        sub_total_per_row = parseFloat(sub_total_per_row).toFixed(2);
        $(this).find('.item_sub_total').val(sub_total_per_row);
        calc_total();
    });
}
function renumber_inputs_name() {
    $(".items-row").each(function (index) {
        var prefix = "items[" + index + "]";
        $(this).find("input,select,textarea").each(function () {
            this.name = this.name.replace(/items\[\d+\]/, prefix);
        });
    });
}
function calc_total()
{
    var grand_total = 0;
    $('.item_total').each(function () {
        var row = $(this).val();
        if (row == null && row == undefined) {
            row = 0;
        }
        grand_total = grand_total + parseFloat(row);
    });
    grand_total = parseFloat(grand_total).toFixed(2);
    $('#grand_total_val').val(grand_total);
    $('#grand_total').text(grand_total);
}
