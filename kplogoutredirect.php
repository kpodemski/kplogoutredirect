<?php
class KPLogoutRedirect extends Module
{
    public function __construct()
    {
        $this->name = 'kplogoutredirect';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->ps_versions_compliancy = array(
            'min' => '1.7.6.0',
            'max' => _PS_VERSION_
        );
        $this->author = 'Krystian Podemski';
        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->trans('Redirection after customer logout', array(), 'Modules.Kplogoutredirect.Admin');
        $this->description = $this->trans('Module will redirect customer to homepage instead of refferer.', array(), 'Modules.Kplogoutredirect.Admin');
    }

    public function isUsingNewTranslationSystem()
    {
        return true;
    }

    public function install()
    {
        return parent::install() && $this->registerHook('actionCustomerLogoutAfter');
    }

    public function hookActionCustomerLogoutAfter()
    {
        Context::getContext()->controller->info[] = $this->trans('Successfully logged out.', array(), 'Modules.Kplogoutredirect.Shop');
        Context::getContext()->controller->redirectWithNotifications('index');
    }
}