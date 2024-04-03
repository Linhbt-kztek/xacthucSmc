$(function () {
  $("#block-add").on("hidden.bs.modal", function () {
    $("#block-add .modal-body").html("");
  });
  /*delete item block*/
  $(document).on("click", ".deleteItemBlock", function () {
    let _tr = $(this).closest("tr");
    let _name_form = _tr.attr("id").split("-")[0];
    var input = _tr.find('input[name*="product_qrcode_id"]');
    value = input.val();
    if (value != "" && value != undefined) {
      $.ajax({
        url: addblock_data.url_delete_block,
        method: "GET",
        data: {
          product_qrcode_id: value,
        },
        success: function (response) {
          console.log(response.message);
        },
        error: function (error) { },
      });
    }
    $(_tr).remove();
    callApiCheckResidual(_name_form);
  });
  $(document).on("click", "#close-popup-btn, #close-popup", function () {
    $("#bg-popup").fadeOut("normal");
    $("#block-add-product").fadeOut("normal");
  });
  /*save form partner*/
  $(document).on("submit", "#form-partner", function (event) {
    event.preventDefault();
    if (validateBlockAdd(1)) {
      var index_key = getTimesTamp();
      $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        dataType: "JSON",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (resp) {
          if (resp.msg == undefined) {
            let _class = "even";
            if ($("#block-partner tr").length % 2 == 0) _class = "odd";
            let _id = resp.data.id;
            let _name = resp.data.name;
            let tr =
              '<tr role="row" id="partner-' + _id + '" class="' + _class + '">';
            tr +=
              '<input name="partner[' +
              index_key +
              '][id]" value="' +
              _id +
              '" type="hidden">';
            tr += '<td style="text-align: left !important;">' + _name + "</td>";
            tr +=
              '<td><input type="number" name="partner[' +
              index_key +
              '][start]" class="form-control partner-start" value="" onkeyup="changeInputBlock(this, \'partner\', \'start\')"></td>';
            tr +=
              '<td><input type="number" name="partner[' +
              index_key +
              '][amount]" class="form-control partner-amount" value="" onkeyup="changeInputBlock(this, \'partner\', \'amount\')"></td>';
            tr +=
              '<td><input type="number" name="partner[' +
              index_key +
              '][end]" class="form-control partner-end" value="" onchange="checkSerialEnd(this)" onkeyup="changeInputBlock(this, \'partner\', \'end\')"></td>';
            tr += '<td class="text-center">';
            tr +=
              '<a href="javascript: void(0);" class="deleteItemBlock" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>';
            tr += "</td>";
            tr += "</tr>";
            $("#block-partner tbody").append(tr);
          } else {
            jAlert(resp.msg, "Thông báo");
            return false;
          }
          $("#block-add").modal("hide");
        },
      });
    }
  });
  /*save form product*/
  $(document).on("submit", "#form-product", function (event) {
    var index_key = getTimesTamp();
    event.preventDefault();
    if (validateBlockAdd(2)) {
      $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        dataType: "JSON",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (resp) {
          if (resp.msg == undefined) {
            let _class = "even";
            if ($("#block-product tr").length % 2 == 0) _class = "odd";
            let _id = resp.data.id;
            let _name = resp.data.name;
            let _code = resp.data.code;
            let _img = resp.data.introimage;
            let tr =
              '<tr role="row" id="product-' + _id + '" class="' + _class + '">';
            tr +=
              '<input name="product[' +
              index_key +
              '][id]" value="' +
              _id +
              '" type="hidden">';
            tr += '<td class="text-left"></td>';
            tr += '<td class="text-left">' + _id + "</td>";
            tr += '<td class="text-center">';
            if (_img != "") {
              tr +=
                '<img src="' +
                _img +
                '" alt="" style="width: 50px; height: 50px">';
            }
            tr += "</td>";
            tr += '<td class="text-left">' + _code + "</td>";
            tr += '<td class="text-left">' + _name + "</td>";
            tr +=
              '<td><input type="number" name="product[' +
              index_key +
              '][start]" class="form-control product-start" value="" onkeyup="changeInputBlock(this, \'product\', \'start\')"></td>';
            tr +=
              '<td><input type="number" name="product[' +
              index_key +
              '][amount]" class="form-control product-amount" value="" onkeyup="changeInputBlock(this, \'product\', \'amount\')"></td>';
            tr +=
              '<td><input type="number" name="product[' +
              index_key +
              '][end]" class="form-control product-end" value="" onchange="checkSerialEnd(this)" onkeyup="changeInputBlock(this, \'product\', \'end\')"></td>';
            tr += "<td>";
            tr +=
              '<select class="form-control" id="protected_time_of_tem_' +
              index_key +
              '" name="product[' +
              index_key +
              '][protected_time_of_tem]">';
            for (let i = 1; i < 100; i++) {
              tr += '<option value="' + i + '">' + i + " tháng</option>";
            }
            tr += "</select></td>";
            tr += '<td class="text-center">';
            tr +=
              '<a href="javascript: void(0);" class="deleteItemBlock" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>';
            tr += "</td>";
            tr += "</tr>";
            $("#block-product tbody").append(tr);
          } else {
            jAlert(resp.msg, "Thông báo");
            return false;
          }
          $("#bg-popup").fadeOut("normal");
          $("#block-add-product").fadeOut("normal");
        },
      });
    }
  });

  /*save form winning*/
  $(document).on("submit", "#form-winning", function (event) {
    event.preventDefault();
    if (validateBlockAdd(2)) {
      $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        dataType: "JSON",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (resp) {
          if (resp.msg == undefined) {
            jAlert("Thêm giải thưởng thành công!", "Thông báo");
          } else {
            jAlert(resp.msg, "Thông báo");
            return false;
          }
          $("#bg-popup").fadeOut("normal");
          $("#block-add-product").fadeOut("normal");
        },
      });
    }
  });
});

function getTimesTamp() {
  var timestamp = new Date().getTime();
  return timestamp;
}

/*add item to block*/
function addItemToBlock(el, type) {
  var index_key = getTimesTamp();
  if (type == 1) {
    let _class = "even";
    if ($("#block-partner tr").length % 2 == 0) _class = "odd";
    let _id = $(el).attr("data-id");
    let _name = $(el).attr("data-name");
    let tr = '<tr role="row" id="partner-' + _id + '" class="' + _class + '">';
    tr +=
      '<input name="partner[' +
      index_key +
      '][id]" value="' +
      _id +
      '" type="hidden">';
    tr += '<td style="text-align: left !important;">' + _name + "</td>";
    tr +=
      '<td><input type="number" name="partner[' +
      index_key +
      '][start]" class="form-control partner-start" value="" onchange="checkResidual(this, \'partner\', \'start\')" onkeyup="changeInputBlock(this, \'partner\', \'start\')"></td>';
    tr +=
      '<td><input type="number" name="partner[' +
      index_key +
      '][amount]" class="form-control partner-amount" value="" onchange="checkResidual(this, \'partner\', \'amount\')" onkeyup="changeInputBlock(this, \'partner\', \'amount\')"></td>';
    tr +=
      '<td><input type="number" name="partner[' +
      index_key +
      '][end]" class="form-control partner-end" value="" onchange="checkResidual(this, \'partner\', \'end\')" onkeyup="changeInputBlock(this, \'partner\', \'end\')"></td>';
    tr += '<td class="text-center">';
    tr +=
      '<a href="javascript: void(0);" class="deleteItemBlock" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>';
    tr += "</td>";
    tr += "</tr>";
    $("#block-partner tbody").append(tr);
    $(el).closest("tr").remove();
    if ($("#block-list-partner tr").length == 0) {
      $("#block-add").modal("hide");
    }
  } else {
    let _class = "even";
    if ($("#block-product tr").length % 2 == 0) _class = "odd";
    let _id = $(el).attr("data-id");
    let _name = $(el).attr("data-name");
    let _code = $(el).attr("data-code");
    let _img = $(el).attr("data-img");
    let tr = '<tr role="row" id="product-' + _id + '" class="' + _class + '">';
    tr +=
      '<input name="product[' +
      index_key +
      '][id]" value="' +
      _id +
      '" type="hidden">';
    tr += '<td class="text-left"></td>';
    tr += '<td class="text-left">' + _id + "</td>";
    tr += '<td class="text-center">';
    if (_img != "") {
      tr += '<img src="' + _img + '" alt="" style="width: 50px; height: 50px">';
    }
    tr += "</td>";
    tr += '<td class="text-left">' + _code + "</td>";
    tr += '<td class="text-left">' + _name + "</td>";
    tr +=
      '<td><input type="number" name="product[' +
      index_key +
      '][start]" class="form-control product-start" value="" onchange="checkResidual(this, \'product\', \'start\')" onkeyup="changeInputBlock(this, \'product\', \'start\')"></td>';
    tr +=
      '<td><input type="number" name="product[' +
      index_key +
      '][amount]" class="form-control product-amount" value="" onchange="checkResidual(this, \'product\', \'amount\')" onkeyup="changeInputBlock(this, \'product\', \'amount\')"></td>';
    tr +=
      '<td><input type="number" name="product[' +
      index_key +
      '][end]" class="form-control product-end" value="" onchange="checkResidual(this, \'product\', \'end\')" onkeyup="changeInputBlock(this, \'product\', \'end\')"></td>';
    tr += "<td>";
    tr +=
      '<select class="form-control" id="protected_time_of_tem_' +
      _id +
      '" name="product[' +
      index_key +
      '][protected_time_of_tem]">';
    for (let i = 1; i < 100; i++) {
      tr += '<option value="' + i + '">' + i + " tháng</option>";
    }
    tr += "</select></td>";
    tr += '<td class="text-center">';
    tr +=
      '<a href="javascript: void(0);" class="deleteItemBlock" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>';
    tr += "</td>";
    tr += "</tr>";
    $("#block-product tbody").append(tr);
    $('select[id^="protected_time_of_tem"]').select2();
    $(el).closest("tr").remove();
    if ($("#block-list-product tr").length == 0) {
      $("#block-add").modal("hide");
    }
  }
}
function checkResidual(el, name_form, name_el) {
  const block_start = parseInt($("#block_start").val());
  const block_end = parseInt($("#block_end").val());

  const product_qrcode_id = $(el).attr("product_qrcode_id");

  input_name = $(el).attr("name");
  input_main = "";

  if (input_name.indexOf("[start]") !== -1) {
    input_main = input_name.replaceAll("[start]", "");
  }

  if (input_name.indexOf("[end]") !== -1) {
    input_main = input_name.replaceAll("[end]", "");
  }

  if (input_name.indexOf("[amount]") !== -1) {
    input_main = input_name.replaceAll("[amount]", "");
  }

  start_number = $("input[name='" + input_main + "[start]']").val();
  end_number = $("input[name='" + input_main + "[end]']").val();

  if (start_number != "" && end_number != "") {
    if (start_number >= block_start && end_number <= block_end) {
      var check_false = false;
      for (const key in addblock_data.all_list_product) {
        element = addblock_data.all_list_product[key];
        if (element.product_qrcode_id != product_qrcode_id) {
          if (!check_false) {
            if (
              (element.start >= start_number && element.start <= end_number) || // element.start nằm giữa start_number và end_number
              (element.end >= start_number && element.end <= end_number) || // element.end nằm giữa start_number và end_number
              (element.start <= start_number && element.end >= end_number) // Cả element.start và element.end đều lớn hơn start_number và nhỏ hơn end_number
            ) {
              check_false = true;
            }
          }
        } else {
          if (!check_false) {
            addblock_data.all_list_product[key].start = start_number;
            addblock_data.all_list_product[key].end = end_number;
          }
        }
      };
      if (check_false) {
        $("input[name='" + input_main + "[start]']").val("");
        $("input[name='" + input_main + "[end]']").val("");
        $("input[name='" + input_main + "[amount]']").val("");
        jAlert(
          "Serial đã trùng với một khoảng tem cấu hình trước đó!",
          "Thông báo"
        );
      }
    } else {
      jAlert("Serial không nằm trong khoảng tem!", "Thông báo");
    }
  }
  callApiCheckResidual(name_form);
}

function callApiCheckResidual(name_form) {
  const used_arr = new Array();
  const name_form_qrcode_id = new Array();
  $("#block-" + name_form + " tbody tr").each(function () {
    if (
      $('input[name*="start"]', $(this)).val() != "" &&
      $('input[name*="end"]', $(this)).val() != ""
    ) {
      used_arr.push(parseInt($('input[name*="start"]', $(this)).val()));
      used_arr.push(parseInt($('input[name*="end"]', $(this)).val()));
      name_form_qrcode_id.push(
        parseInt($('input[name*="' + name_form + '_qrcode_id"]', $(this)).val())
      );
    }
  });
  if (name_form == "product") {
    var url_get = addblock_data.url_checkResidual;
    var data_get = {
      company_id: addblock_data.company_id,
      guid: addblock_data.guid,
      page: addblock_data.page,
      used_arr: used_arr,
      product_qrcode_id: name_form_qrcode_id,
    };
  } else {
    var url_get = "???????";
  }
  $.ajax({
    url: url_get,
    method: "GET",
    data: data_get,
    success: function (response) {
      if (response.status == 200) {
        $("#residual_" + name_form).text(response.result);
        $("#total-block" + name_form).text(response.total);
      }
    },
    error: function (error) {
      console.log("lỗi rồi!");
    },
  });
}
/*change amount*/
function changeInputBlock(el, name_form, name_el) {
  let _parent = $(el).closest("tr");
  let _start = parseInt($("." + name_form + "-start", $(_parent)).val());
  let _amount = parseInt($("." + name_form + "-amount", $(_parent)).val());
  let _end = parseInt($("." + name_form + "-end", $(_parent)).val());
  if ($(el).val() != "") {
    if (
      (name_el == "start" && _amount !== "NaN") ||
      (name_el == "amount" && _start !== "NaN")
    ) {
      $("." + name_form + "-end", $(_parent)).val(_start + _amount - 1);
    } else if (
      (name_el == "start" && _end !== "NaN") ||
      (name_el == "end" && _start !== "NaN")
    ) {
      $("." + name_form + "-amount", $(_parent)).val(_end - _start + 1);
    }
    let total = 0;
    $("#block-" + name_form + " ." + name_form + "-amount").each(function () {
      if ($(this).val() != "") {
        total += parseInt($(this).val());
      }
    });
    if (total > parseInt($("#block_end").val() - $("#block_start").val() + 1)) {
      jAlert("Tổng số tem vượt quá mức cho phép!", "Thông báo", function () {
        $("." + name_form + "-end", $(_parent)).val("");
        $("." + name_form + "-amount", $(_parent)).val("");
        $(el).focus();
      });
      return false;
    } else {
      // 			$('#total-block'+name_form).text(total);
    }
  }
}

/*check and save block residual*/
/*function checkDuplicateAndCalculateBlockResidual(id_tbl) {
  $('#'+id_tbl).
}*/

/*load form add new partner, product; add item to block */
function blockAddForm(type) {
  if (type == 1) {
    $("#block-modal-title").text("Thêm nhà phân phối");
  } else if (type == 2) {
    $("#block-popup-title").text("Thêm sản phẩm");
  } else if (type == 3) {
    $("#block-modal-title").text("Thêm nhà phân phối vào khối");
  } else {
    $("#block-modal-title").text("Thêm Sản phẩm vào khối.");
  }

  $.ajax({
    type: "GET",
    url:
      $("#getFormUrl").val() +
      "/" +
      type +
      "/" +
      $("#partner-company-id").val() +
      "/" +
      $("#partner-guid").val(),
    dataType: "json",
    success: function (resp) {
      if (type == 2) {
        $("#block-add-product .popup-body").html(resp.html);
        $("#block-add-product .popup-body").css({
          "max-height": $("#main-content").css("min-height"),
          "overflow-y": "auto",
        });
        $("#bg-popup").fadeIn();
        $("#block-add-product").fadeIn();
      } else {
        $("#block-add .modal-body").html(resp.html);
        $("#block-add .modal-body").css({
          "max-height": $("#main-content").css("min-height"),
          "overflow-y": "auto",
        });
        $("#block-add").modal("show");
      }
      if (type == 3 || type == 4) {
        $("#block-add .modal-body tr").each(function () {
          // 		if($('tr#'+ $(this).attr('id')).length > 1) {
          // 			$(this).remove();
          // 		}
        });
        if ($("#block-add .modal-body tr").length == 0) {
          let txt =
            type == 3 ? "Không có nhà phân phối nào" : "Không có sản phẩm nào";
          $("#block-add .modal-body").text(txt);
        }
      }
    },
  });
}

/*load form add new winning to block */
function blockAddWinning() {
  $("#block-popup-title").text("Thêm giải thưởng");
  $.ajax({
    type: "GET",
    url: $("#url-add-winning").val(),
    data: {
      company_id: $("#product-company-id").val(),
      guid: $("#product-guid").val(),
    },
    dataType: "json",
    success: function (resp) {
      $("#block-add-product .popup-body").html(resp.html);
      $("#block-add-product .popup-body").css({
        "max-height": $("#main-content").css("min-height"),
        "overflow-y": "auto",
      });
      $("#bg-popup").fadeIn();
      $("#block-add-product").fadeIn();
    },
  });
}

function validateBlockAdd(type) {
  var check = true;
  if (type == 1) {
    $('input#name, input[name="company_id"]', $("#form-partner")).each(
      function () {
        if ($(this).val() == "") {
          jAlert(
            $(this).attr("placeholder") + " không được để trống",
            "Thông báo"
          );
          check = false;
          return false;
        }
      }
    );
  } else {
    $('input#name, input[name="company_id"]', $("#form-product")).each(
      function () {
        if ($(this).val() == "") {
          jAlert(
            $(this).attr("placeholder") + " không được để trống",
            "Thông báo"
          );
          check = false;
          return false;
        }
      }
    );
  }
  return check;
}

function saveBlockPartner() {
  main_layout.show_loader();
  if (block.saveBlockPartnerStatus) {
    $.ajax({
      type: "POST",
      url: $("#form-saveBlockPartner").attr("action"),
      data: $("#form-saveBlockPartner").serialize(),
      dataType: "json",
      success: function (resp) {
        main_layout.hide_loader();
        block.saveBlockPartnerStatus = true;
        if (resp.msg != undefined) {
          jAlert(resp.msg, "Thông báo");
          return false;
        }
      },
    });
  }
}

let block = {
  saveBlockProductStatus: true, //ngăn không cho lưu liên tục
  saveBlockPartnerStatus: true, //ngăn không cho lưu liên tục
};

function saveBlockProduct() {
  main_layout.show_loader();
  if (block.saveBlockProductStatus) {
    block.saveBlockProductStatus = false;
    $.ajax({
      type: "POST",
      url: $("#form-saveBlockProduct").attr("action"),
      data: $("#form-saveBlockProduct").serialize(),
      dataType: "json",
      success: function (resp) {
        main_layout.hide_loader();
        block.saveBlockProductStatus = true;
        if (resp.msg != undefined) {
          jAlert(resp.msg, "Thông báo");
          setTimeout(() => {
            location.reload();
          }, 150);
          return false;
        }
      },
    });
  }
}

function searchTable() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("block-list-product-tbody");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    var matchFound = false; // Sử dụng biến để kiểm soát xem có tìm thấy kết quả phù hợp nào không

    // Lặp qua các cột trong mỗi hàng
    for (var j = 2; j <= 3; j++) {
      // Thay đổi phạm vi cột tương ứng với số cột trong bảng của bạn
      td = tr[i].getElementsByTagName("td")[j];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          matchFound = true; // Nếu tìm thấy kết quả phù hợp trong bất kỳ cột nào, đặt biến này thành true
        }
      }
    }
    // Ẩn hoặc hiển thị hàng tùy thuộc vào việc tìm thấy kết quả phù hợp hay không
    if (matchFound) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}

function searchTablePartner() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInputPartner");
  filter = input.value.toUpperCase();
  table = document.getElementById("block-list-partner");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    var matchFound = false; // Sử dụng biến để kiểm soát xem có tìm thấy kết quả phù hợp nào không

    // Lặp qua các cột trong mỗi hàng
    for (var j = 0; j <= 1; j++) {
      // Thay đổi phạm vi cột tương ứng với số cột trong bảng của bạn
      td = tr[i].getElementsByTagName("td")[j];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          matchFound = true; // Nếu tìm thấy kết quả phù hợp trong bất kỳ cột nào, đặt biến này thành true
        }
      }
    }
    // Ẩn hoặc hiển thị hàng tùy thuộc vào việc tìm thấy kết quả phù hợp hay không
    if (matchFound) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
