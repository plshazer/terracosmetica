function addNewRow() {

  var _row = $(".mdl-data-dynamictable tbody").find('tr');
  var template = $('#basketItemTemplate').html();
  var _newRow = template.replace(/{{id}}/gi, 'checkbox-' + new Date().getTime());

  $(".mdl-data-dynamictable tbody").append(_newRow);
  componentHandler.upgradeAllRegistered();
}

var _isinvalid = false;
$(".add-row").on("click", function() {
  $(".mdl-dialog__addContent").remove();
  addNewRow();
});
var dialog = document.querySelector('dialog');
$(".remove-row").on("click", function() {
  $(".mdl-dialog__addContent").remove();
  
  if ($(".mdl-data-dynamictable tbody").find('tr.is-selected').length != 0)
    {
      dialog.showModal();
    }
   
 

});
$(document).on("click", ".mdl-checkbox", function() {
  var _tableRow = $(this).parents("tr:first");
  if ($(this).hasClass("is-checked") === false) {
    _tableRow.addClass("is-selected");
  } else {
    _tableRow.removeClass("is-selected");
  }

});
$(document).on("click", "#checkbox-all", function() {
  _isChecked = $(this).parent("label").hasClass("is-checked");
  if (_isChecked === false) {
    $(".mdl-data-dynamictable").find('tr').addClass("is-selected");
    $(".mdl-data-dynamictable").find('tr td label').addClass("is-checked");
  } else {
    $(".mdl-data-dynamictable").find('tr').removeClass("is-selected");
    $(".mdl-data-dynamictable").find('tr td label').removeClass("is-checked");
  }

});
$(document).on("click", "span.mdl-data-table__label.add-table-content", function() {
  var _modal, _pattern, _error = "";

  $(".mdl-dialog__addContent").remove();
  if ($(this).parents("td:first").hasClass("mdl-data-table__cell--non-numeric") === false) {
    _pattern = 'pattern="-?[0-9]*(\.[0-9]+)?"';
    _error = "Please, add a numeric value.";
  }

  var template = $('#addContentDialogTemplate').html();
  _modal = template.replace(/{{title}}/, $(this).attr("title")).replace(/{{pattern}}/, _pattern).replace(/{{error}}/, _error);
  $(this).parent().prepend(_modal);
  componentHandler.upgradeDom();
  $(".mdl-textfield__input").focus();
});

$(document).on("click", ".close", function() {
  $(this).parents(".mdl-dialog__addContent").remove();
});

$(document).on("keydown", ".mdl-dialog__addContent", function(e) {
  var code = (e.keyCode ? e.keyCode : e.which);
  switch (code) {
    case 13:
      $(".save.mdl-button").click();
      break;
    case 27:
      $(".close.mdl-button").click();
      break;
    default:
  }
});

$(document).on("click", ".save", function() {
  var _textfield = $(this).parents("td").find(".mdl-textfield");
  var _input = $(this).parents("td").find("input");
  if (_textfield.hasClass("is-invalid") === false && $.trim(_input.val()) !== "") {
    var _col = $(this).parents("td:first");
    var value = _col.hasClass("price") ? "₺ " : "";
    _col.html(value + _input.val());
  }
});

 dialog.querySelector('.close').addEventListener('click', function() {
      dialog.close();
    });
dialog.querySelector('.remove').addEventListener('click', function() {
       $(".mdl-data-dynamictable tbody").find('tr.is-selected').remove();
  $(".mdl-data-dynamictable thead tr").removeClass("is-selected");
  $(".mdl-data-dynamictable thead tr th label").removeClass("is-checked");
  componentHandler.upgradeDom();
  var _row = $(".mdl-data-dynamictable tbody").find('tr');
  console.log("_row.length", _row.length);
  if (_row.length < 1) {
    addNewRow();
  } dialog.close();
    });