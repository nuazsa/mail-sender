$(document).ready(function() {
    // Get the selected version from local storage
    var selectedVersion = localStorage.getItem('selectedVersion');
    if (selectedVersion) {
        $('#versionSelect').val(selectedVersion);
    }

    $('#versionSelect').change(function() {
        selectedVersion = $(this).val();
        // Store the selected version in local storage
        localStorage.setItem('selectedVersion', selectedVersion);
        window.location.href = '/' + selectedVersion;
    });
});