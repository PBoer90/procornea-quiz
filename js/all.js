"use strict";

$(function () {
  // Get the form.
  $.extend($.validator.messages, {
    required: "Dit veld is verplicht.",
    remote: "Please fix this field.",
    email: "Vul een geldig e-mailadres in.",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Please enter a valid number.",
    digits: "Gebruikt alleen nummers.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Vul dezelfde gegevens nog een keer in.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Gebruik niet meer dan {0} karakters."),
    minlength: jQuery.validator.format("Gebruik minstens {0} karakters."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
  });

  var form = $('#subsribe-form').validate({
    errorElement: "span",
    rules: {
      voornaam: 'required',
      achternaam: 'required',
      naam_praktijk: 'required',
      plaats_praktijk: 'required',
      telefoonnummer: {
        required: true,
        minlength: 10,
        maxlength: 10
      },
      emailadres: {
        required: true,
        email: true
      }
    },
    submitHandler: function submitHandler(form) {
      console.log($("#subsribe-form").serialize());
      event.preventDefault();
      $.ajax({
        type: "POST",
        url: "php/form.php",
        data: $("#subsribe-form").serialize()
      }).done(function (response) {
        $("#subsribe-form").empty();
        $("#subsribe-form").append($('<div>').text(response));
        console.log(response);
      }).fail(function (data) {
        $("#subsribe-form").empty();
        $("#subsribe-form").append($('<div>').text(data.responseText));
      });
    }
  });
});
//# sourceMappingURL=all.js.map
