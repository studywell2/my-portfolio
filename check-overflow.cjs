const { chromium } = require('playwright-core');

(async () => {
    const browser = await chromium.launch();

    const mobile = await browser.newPage({ viewport: { width: 375, height: 812 } });
    await mobile.goto('http://127.0.0.1:8094', { waitUntil: 'domcontentloaded', timeout: 60000 });
    await mobile.waitForTimeout(4000);

    // Check for horizontal overflow
    const overflow = await mobile.evaluate(() => {
        const body = document.body;
        const html = document.documentElement;
        const bodyWidth = body.scrollWidth;
        const windowWidth = window.innerWidth;
        const overflowing = bodyWidth > windowWidth;
        
        // Find elements that overflow
        const allElements = document.querySelectorAll('*');
        const overflowers = [];
        for (const el of allElements) {
            const rect = el.getBoundingClientRect();
            if (rect.right > windowWidth + 1 || rect.left < -1) {
                overflowers.push({
                    tag: el.tagName,
                    class: el.className.toString().substring(0, 80),
                    left: Math.round(rect.left),
                    right: Math.round(rect.right),
                    width: Math.round(rect.width),
                });
            }
        }
        
        return {
            bodyWidth,
            windowWidth,
            overflowing,
            overflowers: overflowers.slice(0, 10),
        };
    });

    console.log(JSON.stringify(overflow, null, 2));

    // Full page screenshot
    await mobile.screenshot({ path: 'C:\\Users\\hp\\Desktop\\portt\\s-full.png', fullPage: false });
    
    // Full page screenshot at 320px
    const small = await browser.newPage({ viewport: { width: 320, height: 568 } });
    await small.goto('http://127.0.0.1:8094', { waitUntil: 'domcontentloaded', timeout: 60000 });
    await small.waitForTimeout(4000);
    
    const overflowSmall = await small.evaluate(() => {
        const bodyWidth = document.body.scrollWidth;
        const windowWidth = window.innerWidth;
        const allElements = document.querySelectorAll('*');
        const overflowers = [];
        for (const el of allElements) {
            const rect = el.getBoundingClientRect();
            if (rect.right > windowWidth + 1 || rect.left < -1) {
                overflowers.push({
                    tag: el.tagName,
                    class: el.className.toString().substring(0, 80),
                    left: Math.round(rect.left),
                    right: Math.round(rect.right),
                });
            }
        }
        return { bodyWidth, windowWidth, overflowing: bodyWidth > windowWidth, overflowers: overflowers.slice(0, 10) };
    });
    console.log('--- 320px ---');
    console.log(JSON.stringify(overflowSmall, null, 2));

    await browser.close();
})();
