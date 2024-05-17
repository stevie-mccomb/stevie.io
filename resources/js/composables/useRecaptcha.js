export default async (action = undefined) => {
    if (!window.Laravel.config.services.google.recaptcha.site_key) {
        throw new Error("Google Recaptcha does not have a site key set.");
    }

    return new Promise(resolve => {
        const onScriptLoad = async () => {
            grecaptcha.ready(async () => {
                const token = await grecaptcha.execute(window.Laravel.config.services.google.recaptcha.site_key, { action })

                const input = document.createElement('input');
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', 'g-recaptcha-response');
                input.value = token;

                resolve({ token, input });
            })
        };

        const script = document.createElement('scr' + 'ipt');
        script.addEventListener('load', onScriptLoad);
        script.setAttribute('src', `https://www.google.com/recaptcha/api.js?render=${window.Laravel.config.services.google.recaptcha.site_key}`);
        document.body.appendChild(script);
    });
};