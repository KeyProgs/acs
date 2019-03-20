$(document).ready(function () {
    //var _token= $('#_token').val();
    $('#code_postal').on('change paste keyup', function () {
        getVilleByCodePostal('code_postal', 'ville', 'dropdown');
    });

    $('#code_postale_titulaire_compte').on('change paste keyup', function () {
        getVilleByCodePostal('code_postale_titulaire_compte', 'ville_titulaire_compte', 'dropdown');
    });

    $('#banque_code_postal').on('change paste keyup', function () {
        getVilleByCodePostal('banque_code_postal', 'banque_ville', 'dropdown');
    });


    $('#inscription_form').on('paste keyup', '#banque_nom', function () {
        var nom_banque = $(this).val();
        if (nom_banque.length > 2) {
            $.ajax({
                url: baseUrl+"get-liste-banques",
                type: "GET",
                data: {_token: _token, nom_banque: nom_banque},
                cache: false,
                success: function (data) {
                    if (data.success) {
                        $('#banque-live-search-nom').html(data.data)
                    }
                }
            });
        }
    });
    $('#inscription_form').on('click', '.banque-name', function () {
        var banque_nom = $(this).attr('data-banque-nom');
        $('#banque_nom').val(banque_nom);
        $('#banque-live-search-nom').html('');
        $('.bootstrap-select').selectpicker('refresh');
    });



    $('.dropdown-proposition').on('click', '.link-proposition', function () {
        $('.dropdown-proposition').html('');
        var id = $(this).attr('data-id');
        var value = $(this).attr('data-value');
        //$('#ville_id').val(id);
        $('#ville').val(value);
    });


    //verifier conjoint
    $("#nombre_adultes").on('change', function () {
        var nbr = $(this).val();
        if (nbr === "2") {
            $("#conjoint_section").show();
        } else {
            $("#conjoint_section").hide();
        }
    });

    //verifier enfants
    $("#nombre_enfants").on('change', function () {
        $('.enfant').hide();
        var nbr = $(this).val();
        if (nbr === "0") {
            $("#enfants_section").hide();
        } else {
            for (var i = 1; i <= nbr; i++) {
                $("#enfant_" + i).show();
            }
            $("#enfants_section").show();
        }
    });

    //submit steper wizard event
    $(".btn-update-profile-infos").on('click', function () {
        $.ajax({
            type: "POST",
            url: "inscription",
            data: $("#inscription_form").serialize(),
            cache: false,
            success: function (data) {
                if ($.isEmptyObject(data.errors)) {
                    if (data.success) {
                        if (data.data != null) {
                            $(location).attr('href', 'espace-client');
                        }
                    }
                } else {
                    alert(data.errors);
                }
            }
        });
    });

    //next Step event
    $(".btn-next").on('click', function () {
        var stepIndex = $(this).attr("data-index");
        validateStep(stepIndex);
    });

    //previous Step event
    $(".btn-previous").on('click', function () {
        var stepIndex = $(this).attr("data-index");
        previousStep(stepIndex);
    });
});