<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE VIEW `v_role_abilities` AS select `role_ability`.`id` AS `id`, `role_ability`.`role_id` AS `role_id`, `roles`.`name` AS `role_name`, `abilities`.`id` AS `ability_id`,  `abilities`.`action` AS `action`, `abilities`.`subject` AS `subject` from ((`role_ability` join `abilities` on((`role_ability`.`ability_id` = `abilities`.`id`))) join `roles` on((`role_ability`.`role_id` = `roles`.`id`)))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS `v_role_abilities`');
    }
};
