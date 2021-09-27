<?php
/**
 * Created by PhpStorm.
 * User: Hiệp Nguyễn
 * Date: 27/09/2021
 * Time: 11:06
 */


namespace Nguyenhiep\BookingLunch;


use Carbon\Carbon;
use Nesk\Puphpeteer\Puppeteer;

class User
{
    private $browser;
    private string $username;
    private string $password;
    private string $position;

    public function __construct(string $username, string $password, string $position, string $proxy = null, bool $headless = true)
    {
        $this->username = $username;
        $this->password = $password;
        $this->position = $position;
        $puppeteer      = new Puppeteer([
            'read_timeout' => 600, // 10 minutes
            'idle_timeout' => 180, // 3 minutes
        ]);

        $this->browser = $puppeteer->launch([
            'headless' => $headless,
            'args'     => [
                '--proxy-server=' . $proxy,
                '--no-sandbox'
            ],
        ]);
        $this->browser->userAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36');
    }

    public function __destruct()
    {
        $this->browser->close();
    }

    public function login()
    {
        $page = $this->browser->newPage();
        $page->goto(config("booking-lunch.login_url"), ['waitUntil' => 'networkidle0']);
        $page->type("body > app-root > app-authentication > app-authentication-login > div > div > div > div.form-region > div.input-group.d-inline-block > form > nz-tabset > div > div > div > div.mb-3.email-code-username.ng-star-inserted > input", $this->username);
        $page->type("body > app-root > app-authentication > app-authentication-login > div > div > div > div.form-region > div.input-group.d-inline-block > form > nz-tabset > div > div > div > div.mb-2.password.position-relative.ng-star-inserted > input", $this->password);
        $page->click("body > app-root > app-authentication > app-authentication-login > div > div > div > div.form-region > div.input-group.d-inline-block > form > nz-tabset > div > div > div > button");
        $page->waitForNavigation(["waitUntil" => 'networkidle0']);
        return $page;
    }

    public function book_lunch($page): bool
    {
        try {
            $page->goto(config("booking-lunch.booking_url"), ['waitUntil' => 'networkidle0']);
            $tomorrow = Carbon::tomorrow()->format("l, F j, Y");
            $page->click('document.querySelector("[aria-label="' . $tomorrow . '"]")');
            $page->click('document.querySelector("#layoutEmbed > app-dynamic-embed > app-dynamic-layout-detail > div > layout-embed > div > layout-embed-stack:nth-child(1) > div > nz-affix > div > div > app-d-view > data-table > app-render-tree > div > div > ejs-schedule > div.e-quick-popup-wrapper.e-lib.e-popup.e-control.e-popup-open > div > div.e-popup-footer > div > button")');
            $page->click('#canvas > div > div > div > div:nth-child(1) > div:nth-child(2) > div > app-dynamic-dropdown-control-form > div > div.drop-has-filter.ng-star-inserted > div.d-flex.flex-nowrap.align-items-center.form-control-group.background-component-main.w-100 > nz-select > nz-select-top-control > nz-select-search > input');
            $page->click('document.querySelector("[title="' . $this->position . '"]")');
            $page->click('document.querySelector("#cdk-overlay-16 > nz-modal-container > div > div > div > app-popup-add-item > app-d-form > div > form > div.card-footer.text-xl-right.d-flex.justify-content-end.ng-star-inserted > span:nth-child(2) > button")');
            return true;
        } catch (\Exception $exception) {
        }
        return false;
    }
}