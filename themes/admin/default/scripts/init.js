var url = 'http://localhost/officesub';
function FormatToCurrency(num)
{
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
    return (((sign) ? '' : '-') + num  + ' VND');
}

function CommaFormatted(amount) {
    var delimiter = ","; // replace comma if desired
    amount = new String(amount);
    var a = amount.split('.', 2)
    var d = a[1];
    var i = parseInt(a[0]);
    if (isNaN(i)) {
        return '';
    }
    var minus = '';
    if (i < 0) {
        minus = '-';
    }
    i = Math.abs(i);
    var n = new String(i);
    var a = [];
    while (n.length > 3)
    {
        var nn = n.substr(n.length - 3);
        a.unshift(nn);
        n = n.substr(0, n.length - 3);
    }
    if (n.length > 0) {
        a.unshift(n);
    }
    n = a.join(delimiter);
    if (d.length < 1) {
        amount = n;
    }
    else {
        amount = n + '.' + d;
    }
    amount = minus + amount;
    return amount;
}

function convertToSlug(Text) {
    // Xử lý ký tự Unicode
    in_chrs = 'áàảãạăắặằẳẵâấầẩẫậđéèẻẽẹêếềểễệóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵÁÀẢÃẠĂẮẶẰẲẴÂẤẦẨẪẬĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊíìỉĩịÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰÝỲỶỸỴ',
            out_chrs = 'aaaaaaaaaaaaaaaaadeeeeeeeeeeeooooooooooooooooouuuuuuuuuuuyyyyyAAAAAAAAAAAAAAAAADEEEEEEEEEEEIIIIIiiiiiOOOOOOOOOOOOOOOOOOUUUUUUUUUUUUYYYYY'
    transl = {};

    eval('var chars_rgx = /[' + in_chrs + ']/g');
    for (var i = 0; i < in_chrs.length; i++)
    {
        transl[in_chrs.charAt(i)] = out_chrs.charAt(i);
    }
    Text = Text.replace(chars_rgx, function(match) {
        return transl[match];
    });

    Text = Text
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '')
            .replace(/--/g, '-');

    // Bỏ đi các ký tự đặc biệt
    return Text;
}
$(document).ready(function()
{
    $("#autoId_all").click(function()
    {
        var checked_status = this.checked;
        $("input:checkbox").each(function()
        {
            this.checked = checked_status;
        });
    });
});
//function closebox() {
//    $.fn.colorbox.close();
//}
function goPage(newURL) {

    // if url is empty, skip the menu dividers and reset the menu selection to default
    if (newURL != "") {

        // if url is "-", it is this page -- reset the menu:
        if (newURL == "-") {
            resetMenu();
        }
        // else, send page to designated URL            
        else {
            document.location.href = newURL;
        }
    }
}

// resets the menu selection upon entry to this page:
function resetMenu() {
    document.gomenu.selector.selectedIndex = 2;
}

function del(id) {
    $.ajax({
        type: 'POST',
        url: 'delete',
        data: {
            'id': id
        },
        success: function(data) {
            $.fn.yiiGridView.update('table-grid');
        }
    });

}
function deleteAmount(id) {
    var answer = confirm("Bạn có chắc chắn muốn xóa mẫu tin này không?");
    if (answer) {
        $.ajax({
            type: 'POST',
            url: url + '/order/deleteAmount',
            data: {
                'id': id
            },
            success: function(data) {
                if (data == 1) {
                    $('#' + id).remove();
                }
            }
        });
    }
}
function delOrder(id) {
    $.ajax({
        type: 'POST',
        url: 'delete',
        data: {
            'id': id
        },
        success: function(data) {
            $.fn.yiiGridView.update('table-grid');
        }
    });

}
/**
 * updat
 */
function nameAjax(id) {
    $.ajax({
        type: 'POST',
        url: 'requestId',
        data: {
            'id': id
        },
        success: function(data) {
            var obj = jQuery.parseJSON(data);
            var objname = obj.name;
            if (objname) {
                $('#name' + obj.id).hide();
                $('#textname' + obj.id).show();
            }
        }
    });
}
function updateName(id) {
    $.ajax({
        type: 'POST',
        url: 'changeName',
        data: {
            'id': id,
            'name': document.getElementById("val" + id).value
        },
        success: function(data) {
            $.fn.yiiGridView.update('table-grid');
        }
    });
}
function descriptionAjax(id) {
    $.ajax({
        type: 'POST',
        url: 'requestId',
        data: {
            'id': id
        },
        success: function(data) {
            var obj = jQuery.parseJSON(data);
            var objname = obj.name;
            if (objname) {
                $('#description' + obj.id).hide();
                $('#textdescription' + obj.id).show();
            }
        }
    });
}
function updateDescription(id) {
    $.ajax({
        type: 'POST',
        url: 'changeDescription',
        data: {
            'id': id,
            'name': document.getElementById("valDescription" + id).value
        },
        success: function(data) {
            $.fn.yiiGridView.update('table-grid');
        }
    });
}
//$(document).ready(function() {
//    $("select").uniform();
//})
/**
 * chuyển đổi string trong javascript
 */
function str2num(val) {
    val = '0' + val;
    val = parseFloat(val);
    return val;
}
$("a.colorborViewCustomer").live("click", function() {
    var data = $(this).attr("rel");
    //    var url = $(this).attr("url"); 
    $(".colorborViewCustomer").colorbox({
        href: url + '/ajax/viewCustomer',
        opacity: 0,
        overlayClose: false,
        fixed: true,
        data: {
            "id": data
        },
        title: "",
        type: "POST",
        width: "1100px",
        height: "180px",
        rel: "nofollow"
    });
});
$("a.colorborViewAmountVisa").live("click", function() {
    var data = $(this).attr("rel");
    $(".colorborViewCustomer").colorbox({
        href: url + '/ajax/viewAmountVisa',
        opacity: 0,
        overlayClose: false,
        fixed: true,
        data: {
            "id": data
        },
        title: "",
        type: "POST",
        width: "1100px",
        height: "180px",
        rel: "nofollow"
    });
});

$("a.colorborViewPassport").live("click", function() {
    var data = $(this).attr("rel");
    var i = $(this).attr("i");
    var a = $(this).attr("rela");
    $(".colorborViewPassport").colorbox({
        href: url + '/ajax/viewPassPort',
        opacity: 0,
        overlayClose: false,
        fixed: true,
        data: {
            "id": data,
            "i": i,
            "a": a
        },
        title: "",
        type: "POST",
        width: "600px",
        height: "450px",
        rel: "nofollow"
    });
});



                                                                