const { chromium } = require('playwright-core');

(async () => {
    const browser = await chromium.launch();

    // Portfolio at 375px - full + navbar crop
    const mobile = await browser.newPage({ viewport: { width: 375, height: 812 } });
    await mobile.goto('http://127.0.0.1:8094', { waitUntil: 'domcontentloaded', timeout: 60000 });
    await mobile.waitForTimeout(4000);
    await mobile.screenshot({ path: 'C:\\Users\\hp\\Desktop\\portt\\s1.png' });
    await mobile.screenshot({ path: 'C:\\Users\\hp\\Desktop\\portt\\s1-crop.png', clip: { x: 0, y: 0, width: 375, height: 55 } });

    // Portfolio at 320px
    const small = await browser.newPage({ viewport: { width: 320, height: 568 } });
    await small.goto('http://127.0.0.1:8094', { waitUntil: 'domcontentloaded', timeout: 60000 });
    await small.waitForTimeout(4000);
    await small.screenshot({ path: 'C:\\Users\\hp\\Desktop\\portt\\s2.png' });
    await small.screenshot({ path: 'C:\\Users\\hp\\Desktop\\portt\\s2-crop.png', clip: { x: 0, y: 0, width: 320, height: 55 } });

    await browser.close();
    console.log('Done!');
})();
