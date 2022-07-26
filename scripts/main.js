$("input").click(function (e) {
    e.preventDefault();

    const total_cost = calculate_cost();
    const selected_options = find_selected_options()
    const attributes = find_name_attributes()
    const formData = {}

    function calculate_cost() {
        let result = 0;
        $('#select_box').find('select').each(function () {
            let value = 0;
            if (typeof $(this).val() == 'object') {
                $.each($(this).val(), function (index, val) {
                    value += val * 1;
                });
            } else {
                value = $(this).val()
            }
            result += value * 1;
        });
        return result;
    }

    function find_selected_options() {
        var options = $('#product option:selected');
        var values = $.map(options, function (option) {
            return option.innerHTML;
        });
        return values
    }

    function find_name_attributes() {
        let arr = [];
        $('#select_box').find('select').each(function () {
            el = $(this).attr('name');
            arr.push(el)
        });
        return arr
    }

    for (let i = 0; i < attributes.length; i++) {
        let key = attributes[i];
        formData[key] = selected_options[i];
    }

    formData['cost'] = total_cost;

    $.ajax({
        url: 'form.php',
        type: "POST",
        data: 'jsonData=' + $.toJSON(formData),
        success: function (response) {
            result = JSON.parse(response)
            $('.popup-fade').html(" <div class='popup'><p>Ваш чек:</p><ul> <li>Пицца: <span >" + result['pizza'] + "</span></li> <li>Размер: <span>" + result['size'] + "см</span></li> <li>Соус: <span>" + result['sauce'] + "</span></li><li>Суммарная стоимость: <span>" + result['cost'] + "р</span></li> </ul></div>");
            $('.popup-fade').fadeIn()
        },
        error: function (result) {
            console.log("ошибка")
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    })

    $(this).closest("form").submit();
});
