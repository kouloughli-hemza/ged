<?php

namespace Kouloughli\Providers;

use Kouloughli\Plugins\KouloughliServiceProvider as BaseKouloughliServiceProvider;
use Kouloughli\Support\Plugins\Dashboard\Widgets\BannedUsers;
use Kouloughli\Support\Plugins\Dashboard\Widgets\DirectionChart;
use Kouloughli\Support\Plugins\Dashboard\Widgets\DirectionStats;
use Kouloughli\Support\Plugins\Dashboard\Widgets\DocumentsByDirectionChart;
use Kouloughli\Support\Plugins\Dashboard\Widgets\FilesCharts;
use Kouloughli\Support\Plugins\Dashboard\Widgets\LatestRegistrations;
use Kouloughli\Support\Plugins\Dashboard\Widgets\NewUsers;
use Kouloughli\Support\Plugins\Dashboard\Widgets\RecentFiles;
use Kouloughli\Support\Plugins\Dashboard\Widgets\RegistrationHistory;
use Kouloughli\Support\Plugins\Dashboard\Widgets\TotalDirections;
use Kouloughli\Support\Plugins\Dashboard\Widgets\TotalDocuments;
use Kouloughli\Support\Plugins\Dashboard\Widgets\TotalUsers;
use Kouloughli\Support\Plugins\Dashboard\Widgets\UnconfirmedUsers;
use Kouloughli\Support\Plugins\Dashboard\Widgets\UserActions;
use \Kouloughli\UserActivity\Widgets\ActivityWidget;

class KouloughliServiceProvider extends BaseKouloughliServiceProvider
{
    /**
     * List of registered plugins.
     *
     * @return array
     */
    protected function plugins()
    {
        return [
           // \Kouloughli\Support\Plugins\Dashboard\Dashboard::class,
            \Kouloughli\Support\Plugins\Files::class,
            \Kouloughli\Support\Plugins\Directions::class,
            \Kouloughli\Support\Plugins\Users::class,
            \Kouloughli\UserActivity\UserActivity::class,
            \Kouloughli\Support\Plugins\RolesAndPermissions::class,
            \Kouloughli\Support\Plugins\Settings::class,
            \Kouloughli\Announcements\Announcements::class,
        ];
    }

    /**
     * Dashboard widgets.
     *
     * @return array
     */
    protected function widgets()
    {
        return [
            UserActions::class,
            TotalUsers::class,
            NewUsers::class,
            BannedUsers::class,
            UnconfirmedUsers::class,
            TotalDirections::class,
            TotalDocuments::class,
           // RegistrationHistory::class,
            DocumentsByDirectionChart::class,
            DirectionStats::class,
            FilesCharts::class,
            DirectionChart::class,
            LatestRegistrations::class,
            ActivityWidget::class,
            RecentFiles::class
        ];
    }
}
