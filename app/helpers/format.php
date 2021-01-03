<?php
    /**
     * ######################
     * ####### STRING #######
     * ######################
     */

    if (!function_exists('str_to_number')) {

        /**
         * filtra e retorna apenas numeros
         * @param string $string
         * @return string
         */
        function str_to_number(?string $string): string
        {
            if (!$string) {
                return '';
            }

            return preg_replace('/\D/', '', $string);
        }

    }

    /**
     * ####################
     * ####### DATE DB #######
     * ####################
     */

    if (!function_exists('date_fmt_db')) {

        /**
         * formata a data para o db
         * @param string $date
         * @return string
         */
        function date_fmt_db(?string $date): ?string
        {
            if (!$date) {
                return null;
            }

            if (strpos($date, " ")) {
                $date = explode(" ", $date);

                return (new DateTime(implode("-",
                        array_reverse(explode("/", $date[0])))." ".$date[1]))->format('Y-m-d H:i:s');
            }

            return (new DateTime(implode("-", array_reverse(explode("/", $date)))))->format('Y-m-d');
        }
    }

    /**
     * ####################
     * ####### DATE BR #######
     * ####################
     */

    if (!function_exists('date_fmt_br')) {

        /**
         * formata a data para o db
         * @param string $date
         * @return string
         */
        function date_fmt_br(?string $date): ?string
        {
            if (!$date) {
                return null;
            }

            if (strpos($date, " ")) {
                $date = explode(" ", $date);

                return (new DateTime(implode("-", array_reverse(explode("/", $date[0])))." ".$date[1]))->format('d-m-Y H:i:s');
            }

            return (new DateTime(implode("-", array_reverse(explode("/", $date)))))->format('d-m-Y');
        }
    }

    /**
     * #######################
     * ####### NUMERIC #######
     * #######################
     */

    if (!function_exists('str_to_float')) {


        /**
         * converte string para float
         * @param string|null $string
         * @return float|null
         */
        function str_to_float(?string $string): ?float
        {
            if (!$string) {
                return null;
            }

            return floatval(str_replace(['.', ','], ['', '.'], preg_replace('/[^0-9,.]/', '', $string)));
        }
    }

    /**
     * #######################
     * ####### NUMERIC #######
     * #######################
     */

    if (!function_exists('float_to_str')) {


        /**
         * converte string para float
         * @param float|null $string
         * @return string|null
         */
        function float_to_str(?float $string): ?string
        {
            if (!$string) {
                return null;
            }

            return number_format($string,'2',',','.');
        }
    }
