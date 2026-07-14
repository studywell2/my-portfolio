const { chromium } = require('playwright-core');

(async () => {
    const browser = await chromium.launch();

    const mobile = await browser.newPage({ viewport: { width: 375, height: 812 } });
    await mobile.goto('http://127.0.0.1:8093', { waitUntil: 'domcontentloaded', timeout: 60000 });
    await mobile.waitForTimeout(4000);

    const info = await mobile.evaluate(() => {
        const brand = document.querySelector('.navbar-brand');
        const toggler = document.querySelector('.navbar-toggler');
        const wrapper = document.querySelector('.navbar .container > .d-flex');
        const container = document.querySelector('.navbar .container');
        
        const r = el => el ? el.getBoundingClientRect() : null;
        
        return {
            viewport: window.innerWidth,
            brand: r(brand),
            toggler: r(toggler),
            wrapper: r(wrapper),
            container: r(container),
            wrapperClasses: wrapper ? wrapper.className : null,
            togglerClasses: toggler ? toggler.className : null,
        };
    });

    console.log(JSON.stringify(info, null, 2));
    await browser.close();
})();
