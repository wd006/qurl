document.addEventListener('DOMContentLoaded', function() {

    const protocolToggle = document.getElementById('protocolToggle');
    const protocolDisplay = document.getElementById('protocol-display');

    if (!protocolToggle) {
        console.error("ERROR(ssl-toggle.js): checkbox 'protocolToggle' not found");
        return;
    }
    if (!protocolDisplay) {
        console.error("ERROR(ssl-toggle.js): span 'protocol-display' not found"); // TODO: protocolDisplay
        return;
    }

    console.log("INFO(ssl-toggle.js): elements found");

    function updateProtocol() {
        if (protocolToggle.checked) {
            protocolDisplay.textContent = 'https://';
            protocolDisplay.style.color = '#3b82f6';
            console.log("INFO(ssl-toggle.js): selected HTTPS");
        } else {
            protocolDisplay.textContent = 'http://';
            protocolDisplay.style.color = '#bbb';
            console.log("INFO(ssl-toggle.js): selected HTTP");
        }
    }

    protocolToggle.addEventListener('change', updateProtocol);
    
    updateProtocol();
});