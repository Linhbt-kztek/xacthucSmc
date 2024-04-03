$(function () {
  /*checkAll checkbox in index page*/
  $("#checkAll").click(function () {
    if ($(this).is(":checked")) {
      $(".checkItem").prop("checked", true);
    } else {
      $(".checkItem").prop("checked", false);
    }
  });
  $(".checkItem").click(function () {
    if ($(this).is(":checked")) {
      if ($(".checkItem:checked").length == $(".checkItem").length) {
        $("#checkAll").prop("checked", true);
      }
    } else {
      $("#checkAll").prop("checked", false);
    }
  });

  $("#search").click(function () {
    $("#collapse-search-form").trigger("click");
  });

  /*show page*/
  $(".showPage").change(function () {
    $("#pageSize").val($(this).val());
    $("#search-form").submit();
  });

  /*reverse item*/
  $(".reverseItem").click(function () {
    let tmpId = $(this).attr("id");
    let id = $(this).attr("data-id");
    $.ajax({
      url: $(this).attr("data-href"),
      type: "POST",
      async: false,
      data: { id: id },
      dataType: "json",
      success: function (resp) {
        if (resp.error) {
          jAlert("Không tìm thấy yêu cầu của bạn!", "Thông báo");
        } else {
          $("#" + tmpId + " i").removeClass(resp.rm);
          $("#" + tmpId + " i").addClass(resp.add);
        }
      },
    });
  });

  $("#parent_id").click(function () {
    if ($("#type_cat").val() == 0) {
      jAlert("Bạn chưa chọn loại danh mục", "Thông báo");
      return false;
    }
  });

  /*delete item*/
  $(".deleteItem").click(function () {
    let id = $(this).attr("id");
    let href = $("#delUrl").val();
    let msgConfirm = "";
    if (href.includes("company/delete")) {
      msgConfirm =
        "Tất cả dữ liệu về Nhà Phân Phối, Sản Phẩm, Lịch sử in - quét QRCode, Thông tin liên quan đến Công ty sẽ bị xoá. ";
    } else if (href.includes("partner/delete")) {
      msgConfirm =
        "Tất cả dữ liệu về Lịch sử in - quét QRCode, Thông tin liên quan đến Nhà phân phối sẽ bị xoá. ";
    } else if (href.includes("product/delete")) {
      msgConfirm =
        "Tất cả dữ liệu về Lịch sử in - quét QRCode, Thông tin liên quan đến Sản phẩm sẽ bị xoá. ";
    }
    msgConfirm += msgConfirm
      ? "\nBạn chắc chắn muốn xóa?"
      : "Bạn chắc chắn muốn xóa?";

    jConfirm(msgConfirm, "Xác nhận", function (r) {
      if (r) {
        if (
          $("#guid_active_id").val() != undefined &&
          $("#guid_active_id").val() != ""
        ) {
          location.href =
            href + "/" + id + "?guid=" + $("#guid_active_id").val();
        } else {
          location.href = href + "/" + id;
        }
      } else {
        return false;
      }
    });
  });

  /*delete all item*/
  $(".deleteAll").click(function () {
    let listId = "";
    $(".checkItem").each(function () {
      if ($(this).is(":checked")) {
        if (listId.length == 0) {
          listId = $(this).val();
        } else {
          listId += "," + $(this).val();
        }
      }
    });
    let href = $("#delUrl").val();
    if (listId == "") {
      jAlert("Bạn chưa chọn dòng nào", "Thông báo");
      return false;
    } else {
      let msgConfirm = "";
      if (href.includes("company/delete")) {
        msgConfirm =
          "Tất cả dữ liệu về Nhà Phân Phối, Sản Phẩm, Lịch sử in - quét QRCode, Thông tin liên quan đến Công ty sẽ bị xoá. ";
      } else if (href.includes("partner/delete")) {
        msgConfirm =
          "Tất cả dữ liệu về Lịch sử in - quét QRCode, Thông tin liên quan đến Nhà phân phối sẽ bị xoá. ";
      } else if (href.includes("product/delete")) {
        msgConfirm =
          "Tất cả dữ liệu về Lịch sử in - quét QRCode, Thông tin liên quan đến Sản phẩm sẽ bị xoá. ";
      }
      msgConfirm += msgConfirm
        ? "\nBạn chắc chắn muốn xóa?"
        : "Bạn chắc chắn muốn xóa?";
      jConfirm(msgConfirm, "Xác nhận", function (r) {
        if (r) {
          if (
            $("#guid_active_id").val() != undefined &&
            $("#guid_active_id").val() != ""
          ) {
            location.href =
              href + "/" + listId + "?guid=" + $("#guid_active_id").val();
          } else {
            location.href = href + "/" + listId;
          }
        } else {
          return false;
        }
      });
    }
  });
});
/*attact file*/
function attactFile(file) {
  $("#icon-attact").show();
  $("#attact_file_name").text(file.name);
}

/*preview Qrcode*/
function previewQrcodeForm(_url) {
  $.ajax({
    type: "GET",
    url: _url,
    dataType: "json",
    success: function (resp) {
      $("#block-modal-title").text("Quét QRcode");
      $("#block-add .modal-body").html(resp);
      $("#block-add").modal("show");
    },
  });
}

let doom_layout = {
  validateEmail: function (email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
  },
  validatePhoneNumber: function name(phoneNumber) {
    var re = /^(?:0|\d{10})$/;
    return re.test(phoneNumber);
  },
};

function destroyOrActiveMutipleQrcode(type, url) {
  data = {
    type: type,
    company_id: $("#mutipleActionModal_company_id").val(),
    start_serial: $("#mutipleActionModal_start_serial").val(),
    end_serial: $("#mutipleActionModal_end_serial").val(),
    get_customer_info: false,
    customer_name: "",
    customer_email: "",
    customer_phone: "",
    customer_address: "",
  };

  check = true;
  message = "";

  if (check) {
    if (
      data.company_id == null ||
      data.company_id == "" ||
      data.company_id == undefined
    ) {
      check = false;
      message = "Vui lòng chọn công ty!";
    }
  }
  if (check) {
    if (
      data.start_serial == null ||
      data.start_serial == "" ||
      data.start_serial == undefined
    ) {
      check = false;
      message = "Vui lòng điền serial bắt đầu!";
    }
  }
  if (check) {
    if (
      data.end_serial == null ||
      data.end_serial == "" ||
      data.end_serial == undefined
    ) {
      check = false;
      message = "Vui lòng điền serial kết thúc!";
    }
  }
  if (check) {
    if (data.end_serial < data.start_serial) {
      check = false;
      message = "Serial bắt đầu phải nhỏ hơn serial kết thúc!";
    }
  }

  const checkBox = document.getElementById("get_customer_info");

  if (checkBox.checked) {
    data.get_customer_info = true;
    data.customer_name = $("#modal_customer_name").val();
    data.customer_email = $("#modal_customer_email").val();
    data.customer_phone = $("#modal_customer_phone").val();
    data.customer_address = $("#modal_customer_address").val();

    if (check) {
      if (
        data.customer_name == null ||
        data.customer_name == "" ||
        data.customer_name == undefined
      ) {
        check = false;
        message = "Vui lòng cung cấp họ và tên!";
      }
    }

    if (check) {
      if (
        data.customer_email == null ||
        data.customer_email == "" ||
        data.customer_email == undefined
      ) {
        check = false;
        message = "Vui lòng cung cấp email!";
      }
    }

    if (check) {
      if (!(doom_layout.validateEmail(data.customer_email))) {
        check = false;
        message = "Email không hợp lệ!";
      }
    }

    if (check) {
      if (
        data.customer_phone == null ||
        data.customer_phone == "" ||
        data.customer_phone == undefined
      ) {
        check = false;
        message = "Vui lòng cung cấp số điện thoại!";
      }
    }

    if (check) {
      if (!(doom_layout.validatePhoneNumber(data.customer_phone))) {
        check = false;
        message = "Số điện thoại không hợp lệ!";
      }
    }

    if (check) {
      if (
        data.customer_address == null ||
        data.customer_address == "" ||
        data.customer_address == undefined
      ) {
        check = false;
        message = "Vui lòng cung cấp số điện thoại!";
      }
    }
  }

  if (check) {
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      dataType: "json",
      success: function (rsp) {
        console.log(rsp);
        if (rsp.status == 200) {
          jAlert(rsp.message, "Thông báo");
          location.reload();
        } else {
          jAlert(rsp.message, "Thông báo");
          //  location.reload();
        }
      },
    });
  } else {
    jAlert(message, "Thông báo");
  }
}

function clickShowFormCustomerInfo() {
  var checkBox = document.getElementById("get_customer_info");
  if (checkBox.checked) {
    // alert("Checkbox is checked");
    $("#customerInfo").removeClass("d-none");
  } else {
    // alert("Checkbox is not checked");
    $("#customerInfo").addClass("d-none");
  }
}

function showModalDestroyOrActiveMutipleQrcode() {
  $("#mutipleActionModal").modal("show");
}

/*createAlias*/
function createAlias(string) {
  // First, remove any multi space with single space
  string = string.replace(/ +(?= )/g, "");

  // Second, remove first and last space if had
  string = string.trim();

  // Sigend to un-signed
  let signedChars =
    "àảãáạăằẳẵắặâầẩẫấậđèẻẽéẹêềểễếệìỉĩíịòỏõóọôồổỗốộơờởỡớợùủũúụưừửữứựỳỷỹýỵÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬĐÈẺẼÉẸÊỀỂỄẾỆÌỈĨÍỊÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢÙỦŨÚỤƯỪỬỮỨỰỲỶỸÝỴ";
  let unsignedChars =
    "aaaaaaaaaaaaaaaaadeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyyAAAAAAAAAAAAAAAAADEEEEEEEEEEEIIIIIOOOOOOOOOOOOOOOOOUUUUUUUUUUUYYYYY";
  let pattern = new RegExp("[" + signedChars + "]", "g");
  let output = string.replace(pattern, function (m, key, input) {
    return unsignedChars.charAt(signedChars.indexOf(m));
  });

  // Remove all special characters
  output = output.replace(/[^a-z0-9\s]/gi, "");

  // Replace white space with dash, and lowercase all characters
  output = output.replace(/\s+/g, "-").toLowerCase();

  return output;
}
