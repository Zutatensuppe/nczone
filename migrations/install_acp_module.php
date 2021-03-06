<?php
/**
 *
 * nC Zone. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Marian Cepok, https://new-chapter.eu
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace eru\nczone\migrations;

use eru\nczone\config\acl;
use eru\nczone\config\config;

class install_acp_module extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return isset($this->config['nczone_draw_player_civs']);
    }

    static public function depends_on()
    {
        return array('\phpbb\db\migration\data\v31x\v314');
    }

    public function update_data()
    {
        return \array_merge(config::module_data(config::ACL_CONFIG_KEYS), [
            [
                'module.add', [
                'acp',
                'ACP_CAT_DOT_MODS',
                'ACP_NCZONE_TITLE'
            ]
            ],
            [
                'module.add', [
                'acp',
                'ACP_NCZONE_TITLE',
                [
                    'module_basename'	=> '\eru\nczone\acp\main_module',
                    'modes'				=> ['general', 'draw'],
                ],
            ]
            ],
        ], acl::module_data(acl::PERMISSIONS_ADMIN, acl::ROLE_ADMIN));
    }
}
