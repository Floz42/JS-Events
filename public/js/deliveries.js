/**
 * @descrption change parameters of inputs
 */
$("#delivery_optionDeliveries fieldset .form-group").each(function(){
    $(this).addClass('d-flex');
    $(this).append('<a href="" class="ml-2 delete_option btn btn-danger"><i class="fas fa-trash" title="Supprimer"></i></a>');
    $(this).children('label').remove();
});

/**
 * @description remove labels of inputs
 */
$("legend").each(function(){
    if ($(this).text() != "Options :") {
        $(this).remove();
    }
})

/**
 * @description count each input in relation with options of one delivery
 */
function countOptions() {
    let count = 0;
    $("#delivery_optionDeliveries .form-group").each(function(){
        count++
    });
    return count;
}

/**
 * @description redistribute attributes name and input of images input when whe delete one of them
 */
function redistributeName() {
    for (let i = 0; i < countOptions(); i++){
        let target = '#delivery_optionDeliveries .form-group input:eq(' + i + ')';
        $(target).attr('name', "delivery[optionDeliveries][" + i + "][title]");
        $(target).attr('id', "delivery_optionDeliveries_" + i + "_title");
        $(target).parent().parent().attr('id', "delivery_optionDeliveries_" + i);
    }
}

/**
 * @description delete an input option
 */
function onDelete() {
    $('.delete_option').click(function(e) {
        e.preventDefault();
        $(this).parent().parent().parent().remove();
        countOptions();
        redistributeName();
    })
}

countOptions();
onDelete();

/**
 * @description append button add option to the DOM
 */
let addOption = "<div id='addOption' class='mb-3 btn btn-success'><i class='fas fa-plus'></i>Ajouter une option</div>"
$('#delivery_optionDeliveries').append(addOption);

/**
 * @description add an input when user click on addoption button
 */
$('#addOption').click(function() {
    let newInput = '<fieldset class="form-group"><div id="delivery_optionDeliveries_1"><div class="form-group d-flex"><input type="text" id="delivery_options_2" name="delivery[options][2]" required="required" class="form-control" value=""><a href="" class="ml-2 delete_option btn btn-danger"><i class="fas fa-trash" title="Supprimer"></i></a></div></div></fieldset>';
    $('#delivery_optionDeliveries').append(newInput);
    countOptions();
    redistributeName();
    onDelete();
})
