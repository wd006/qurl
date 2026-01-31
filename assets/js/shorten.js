document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('shortenForm');
    const submitBtn = document.getElementById('submitBtn');
    
    const ui = {
        setLoading(isLoading) {
            const btnText = submitBtn.querySelector('.btn-text');
            const spinner = submitBtn.querySelector('.loading-spinner');
            submitBtn.disabled = isLoading;
            btnText.classList.toggle('hidden', isLoading);
            spinner.classList.toggle('hidden', !isLoading);
        }
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        ui.setLoading(true);

        try {
            const formData = new FormData(form);
            const response = await fetch('/api/v1/shorten', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            handleResponse(result);

            if (result.status === 'success') {
                form.reset();
                if (window.turnstile) window.turnstile.reset(); // reset captaha
            }

        } catch (error) {
            console.error(error);
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'A connection error occured.',
                customClass: { popup: 'tiny-swal-popup' }
            });
        } finally {
            ui.setLoading(false);
        }
    });
});

function handleResponse(response) {
    
    const swalOptions = {
        title: response.message,
        buttonsStyling: false,
        customClass: {
            popup: 'tiny-swal-popup',
            title: 'tiny-swal-title',
            htmlContainer: 'tiny-swal-content',
            confirmButton: 'tiny-swal-btn',
        },
        confirmButtonText: 'OK'
    };

    if (response.status === 'success') {

        const contentNode = prepareSuccessContent(response.data);
        
        Swal.fire({
            ...swalOptions,
            icon: 'success',
            html: contentNode, // DOM
            didOpen: () => {
                const input = Swal.getHtmlContainer().querySelector('.js-short-url');
                // if(input) input.select(); // select link
            }
        });
    } else {
        // error
        Swal.fire({
            ...swalOptions,
            icon: 'error',
            text: response?.details || 'An unknown error occurred.'
        });
    }
}

function prepareSuccessContent(data) {
    
    // clone template
    const template = document.getElementById('swal-success-template');
    const clone = template.content.cloneNode(true);
    
    const container = document.createElement('div');
    container.appendChild(clone);

    const fullLink = data.full_url || `${window.location.origin}/${data.alias}`;
    const inputEl = container.querySelector('.js-short-url');
    const copyBtn = container.querySelector('.js-copy-btn');
    const tipSection = container.querySelector('.js-tip-section');
    const manageLink = container.querySelector('.js-manage-link');

    inputEl.value = fullLink;

    // copy
    copyBtn.addEventListener('click', () => handleCopyAction(inputEl, copyBtn));

    if (data.admin && data.admin.enabled) {
        const manageUrl = fullLink + "+";
        tipSection.style.display = 'flex';
        manageLink.textContent = manageUrl;
        manageLink.href = manageUrl;
    }

    return container;
}

function handleCopyAction(inputElement, btnElement) {
    inputElement.select();
    inputElement.setSelectionRange(0, 99999); // mobile

    navigator.clipboard.writeText(inputElement.value).then(() => {

        // change copy icon
        const originalHtml = btnElement.innerHTML;
        
        btnElement.classList.add('copied');
        btnElement.innerHTML = `
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        `; // tick icon

        setTimeout(() => {
            btnElement.classList.remove('copied');
            btnElement.innerHTML = originalHtml;
        }, 2000);
    }).catch(err => {
        console.error('Copy failed:', err);
    });
}