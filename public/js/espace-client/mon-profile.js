$(document).ready(function () {
    $('#code_postal').on('change paste keyup', function () {
        getVilleByCodePostal('code_postal', 'ville', 'dropdown');
    });

    $('.dropdown-proposition').on('click', '.link-proposition', function () {
        $('.dropdown-proposition').html('');
        var id = $(this).attr('data-id');
        var value = $(this).attr('data-value');
        //$('#ville_id').val(id);
        $('#ville').val(value);
    });

    //auto hide conjoint && enfants section
    //$("#conjoint_section").hide();
    //$("#enfants_section").hide();
    //auto hide single enfant
    //$('.enfant').hide();

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