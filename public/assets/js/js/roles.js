$(document).ready(function () {
    console.log('laith bad boy he is angry and not handle me very well')
    window.changeGuard = function() {
        var baseUrl = window.location.origin;
        let guard_name = $("#guard").val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "get",
            dataType: "json",
            url: baseUrl + "/admin/ajax/role/get_role_based/" + guard_name,
            success: function (response) {
                if (response["status"] === 200) {
                    $("#labelPermission").removeClass("d-none");
                    var permissions = response.data[0];
                    var permissionsContainer = $("#permissions");
                    permissionsContainer.empty();

                    $.each(permissions, function (index, permission) {
                        var colDiv = $("<div>").addClass("col-md-4");
                        var checkboxDiv =
                            $("<div>").addClass("form-check mb-3");
                        var checkbox = $("<input>")
                            .addClass("form-check-input")
                            .attr({
                                type: "checkbox",
                                name: "permissions[]",
                                id: "formCheck" + index,
                                value: permission.name,
                            });

                        var label = $("<label>")
                            .addClass("form-check-label")
                            .attr("for", "formCheck" + index)
                            .text(permission.name_i18n);
                        checkboxDiv.append(checkbox);
                        checkboxDiv.append(label);
                        colDiv.append(checkboxDiv);
                        permissionsContainer.append(colDiv);
                    });
                } else {
                    var permissionsContainer = $("#permissions");
                    permissionsContainer.empty();
                    $("#labelPermission").addClass("d-none");
                    toastr.error("{{ __('app.no-permissions-found') }}");
                }
            },
        });
    }
});
