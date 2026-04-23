document.addEventListener('DOMContentLoaded', function() {

    const protocolToggle = document.getElementById('protocolToggle');
    const protocolDisplay = document.getElementById('protocol-display');

    if (!protocolToggle) {
        console.error("ERROR(ssl-toggle.js): checkbox 'protocolToggle' not found");
        return;
    }
    if (!protocolDisplay) {
        console.error("ERROR(ssl-toggle.js): span 'protocol-display' not found"); // TODO: rename to protocolDisplay
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

document.addEventListener("DOMContentLoaded", function() {
    
    const settingCards = document.querySelectorAll('.setting-card');

    settingCards.forEach(card => {
        const checkbox = card.querySelector('input[type="checkbox"]');
        const input = card.querySelector('.setting-input');

        if (checkbox && input) {

            input.disabled = !checkbox.checked;

            checkbox.addEventListener('change', function() {
                input.disabled = !this.checked;
                if (!this.checked) {
                    input.value = ''; // truncate input
                }
            });
        }
    });

    const previewInput = document.querySelector('input[name="preview[note]"]');
    
    if (previewInput) {

        const warningTextElement = previewInput.parentElement.querySelector('.text-warning');
        let warningTimeout;

        previewInput.addEventListener('input', function(e) {

            const invalidCharsRegex = /[^a-zA-Z0-9çğıöşüÇĞİÖŞÜ\s]/g;

            if (invalidCharsRegex.test(this.value)) {
                
                this.value = this.value.replace(invalidCharsRegex, '');

                clearTimeout(warningTimeout); 

                this.classList.add('input-error', 'shake-anim');
                if (warningTextElement) {
                    warningTextElement.classList.add('text-error', 'shake-anim');
                }

                warningTimeout = setTimeout(() => {
                    this.classList.remove('input-error', 'shake-anim');
                    if (warningTextElement) {
                        warningTextElement.classList.remove('text-error', 'shake-anim');
                    }
                }, 800);
            }
        });
    }
});