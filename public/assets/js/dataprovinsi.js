$(document).ready(() => {
  $.ajax({
    url: "http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
    method: "GET",
    success: function (response) {
      if (response) {
        let eachRes = response;
        eachRes.forEach((element) => {
          $("#merchant_provinsi").append(
            `<option value="${element["id"]}-${element["name"]}">${element["name"]}</option>`
          );
        });
      }
    },
  });

  $("#merchant_provinsi").on("change", function () {
    let value = $(this).val();
    if (value != "" || value != "Pilih Provinsi...") {
      $("#merchant_kota").html(
        "<option selected>Pilih Kota/Kabupaten...</option>"
      );
      $("#merchant_kecamatan").html(
        "<option selected>Pilih Kecamatan...</option>"
      );
      $("#merchant_kelurahan").html(
        "<option selected>Pilih Kelurahan...</option>"
      );

      value = value.split("-");

      $.ajax({
        url:
          "http://www.emsifa.com/api-wilayah-indonesia/api/regencies/" +
          value[0] +
          ".json",
        method: "GET",
        success: function (response) {
          if (response) {
            let eachRes = response;
            eachRes.forEach((element) => {
              $("#merchant_kota").append(
                `<option value="${element["id"]}-${element["name"]}">${element["name"]}</option>`
              );
            });
          }
        },
      });
    }
  });

  $("#merchant_kota").on("change", function () {
    let value = $(this).val();
    if (value != "" || value != "Pilih Kota/Kabupaten...") {
      $("#merchant_kecamatan").html(
        "<option selected>Pilih Kecamatan...</option>"
      );
      $("#merchant_kelurahan").html(
        "<option selected>Pilih Kelurahan...</option>"
      );

      value = value.split("-");

      $.ajax({
        url:
          "http://www.emsifa.com/api-wilayah-indonesia/api/districts/" +
          value[0] +
          ".json",
        method: "GET",
        success: function (response) {
          if (response) {
            let eachRes = response;
            eachRes.forEach((element) => {
              $("#merchant_kecamatan").append(
                `<option value="${element["id"]}-${element["name"]}">${element["name"]}</option>`
              );
            });
          }
        },
      });
    }
  });

  $("#merchant_kecamatan").on("change", function () {
    let value = $(this).val();
    if (value != "" || value != "Pilih Kecamatan...") {
      $("#merchant_kelurahan").html(
        "<option selected>Pilih Kelurahan...</option>"
      );

      value = value.split("-");

      $.ajax({
        url:
          "http://www.emsifa.com/api-wilayah-indonesia/api/villages/" +
          value[0] +
          ".json",
        method: "GET",
        success: function (response) {
          if (response) {
            let eachRes = response;
            eachRes.forEach((element) => {
              $("#merchant_kelurahan").append(
                `<option value="${element["id"]}-${element["name"]}">${element["name"]}</option>`
              );
            });
          }
        },
      });
    }
  });
});
