<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ Check if new fields exist in the admission_course_batch table
        $hasInstallmentColumns = Schema::hasColumn('admission_course_batch', 'payment_type');

        // ✅ Prepare base SQL insert (with optional new fields)
        $columns = "
            id AS admission_id,
            course_id,
            batch_id,
            full_fee AS course_fee,
        ";

        // If new columns exist, include them from admissions if they exist
        if ($hasInstallmentColumns) {
            if (Schema::hasColumn('admissions', 'payment_type')) {
                $columns .= "payment_type, ";
            } else {
                $columns .= "'full_fee' AS payment_type, ";
            }

            if (Schema::hasColumn('admissions', 'installment_count')) {
                $columns .= "installment_count, ";
            } else {
                $columns .= "NULL AS installment_count, ";
            }

            if (Schema::hasColumn('admissions', 'installment_1')) {
                $columns .= "installment_1, ";
            } else {
                $columns .= "NULL AS installment_1, ";
            }

            if (Schema::hasColumn('admissions', 'installment_2')) {
                $columns .= "installment_2, ";
            } else {
                $columns .= "NULL AS installment_2, ";
            }

            if (Schema::hasColumn('admissions', 'installment_3')) {
                $columns .= "installment_3, ";
            } else {
                $columns .= "NULL AS installment_3, ";
            }

            if (Schema::hasColumn('admissions', 'apply_additional_charges')) {
                $columns .= "apply_additional_charges, ";
            } else {
                $columns .= "0 AS apply_additional_charges, ";
            }
        }

        // Add timestamps
        $columns .= "NOW(), NOW()";

        // ✅ Final safe SQL insert
        DB::statement("
            INSERT INTO admission_course_batch (
                admission_id, course_id, batch_id, course_fee
                " . ($hasInstallmentColumns ? ", payment_type, installment_count, installment_1, installment_2, installment_3, apply_additional_charges" : "") . ",
                created_at, updated_at
            )
            SELECT
                {$columns}
            FROM admissions
            WHERE course_id IS NOT NULL
              AND batch_id IS NOT NULL
              AND NOT EXISTS (
                  SELECT 1 FROM admission_course_batch acb
                  WHERE acb.admission_id = admissions.id
              )
        ");
    }

    public function down(): void
    {
        // Optional: rollback inserted pivot data
        DB::table('admission_course_batch')->delete();
    }
};
