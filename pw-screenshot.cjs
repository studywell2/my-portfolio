const { chromium } = require('playwright');

(async () => {
    const browser = await chromium.launch();

    // Desktop homepage - projects section
    const page1 = await browser.newPage({ viewport: { width: 1280, height: 800 } });
    await page1.goto('http://127.0.0.1:8093', { waitUntil: 'domcontentloaded', timeout: 60000 });
    await page1.waitForTimeout(5000);

    await page1.evaluate(() => {
        document.getElementById('projects').scrollIntoView();
    });
    await page1.waitForTimeout(2000);
    await page1.screenshot({ path: 'C:\\Users\\hp\\Desktop\\portt\\desktop-projects.png' });

    // Open AI chat
    await page1.evaluate(() => window.scrollTo(0, 0));
    await page1.waitForTimeout(500);
    await page1.click('#ai-chat-toggle');
    await page1.waitForTimeout(1000);
    await page1.screenshot({ path: 'C:\\Users\\hp\\Desktop\\portt\\desktop-ai-chat.png' });

    // Click "About Me" quick action
    await page1.click('.quick-btn');
    await page1.waitForTimeout(3000);
    await page1.screenshot({ path: 'C:\\Users\\hp\\Desktop\\portt\\desktop-ai-response.png' });

    // Mobile AI chat
    const page2 = await browser.newPage({ viewport: { width: 375, height: 812 } });
    await page2.goto('http://127.0.0.1:8093', { waitUntil: 'domcontentloaded', timeout: 60000 });
    await page2.waitForTimeout(5000);
    await page2.click('#ai-chat-toggle');
    await page2.waitForTimeout(1000);
    await page2.screenshot({ path: 'C:\\Users\\hp\\Desktop\\portt\\mobile-ai-chat.png' });

    // Case study page desktop
    const page3 = await browser.newPage({ viewport: { width: 1280, height: 800 } });
    await page3.goto('http://127.0.0.1:8093/case-studies/schoolpro', { waitUntil: 'domcontentloaded', timeout: 60000 });
    await page3.waitForTimeout(3000);
    await page3.screenshot({ path: 'C:\\Users\\hp\\Desktop\\portt\\desktop-case-study.png' });

    // Case study page mobile
    const page4 = await browser.newPage({ viewport: { width: 375, height: 812 } });
    await page4.goto('http://127.0.0.1:8093/case-studies/schoolpro', { waitUntil: 'domcontentloaded', timeout: 60000 });
    await page4.waitForTimeout(3000);
    await page4.screenshot({ path: 'C:\\Users\\hp\\Desktop\\portt\\mobile-case-study.png' });

    await browser.close();
    console.log('Done!');
})();
