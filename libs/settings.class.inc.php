<?php

class settings {

	private const DEBUG = false;
	private const TITLE = "PHP Quiz";
	private const TIMEZONE = "UTC";
	private const SESSION_TIMEOUT = 300;
        private const LDAP_HOST = "localhost";
        private const LDAP_PORT = 389;
        private const LDAP_BASE_DN = "";
        private const LDAP_SSL = false;
        private const LDAP_TLS = false;
        private const LDAP_BIND_USER = "";
        private const LDAP_BIND_PASS = "";
	private const MYSQL_HOST = "localhost";
	private const MYSQL_PORT = 3306;
	private const MYSQL_SSL = false;

	public static function get_debug() {
		if (defined("DEBUG") && is_bool(DEBUG)) {
			return DEBUG;
		}
		return self::DEBUG;

	}

	public static function get_version() {
		return VERSION;
	}

	public static function get_codewebsite_url() {
		return CODEWEBSITE_URL;
	}

	public static function get_title() {
		if (defined("TITLE") && (TITLE != "")) {
			return TITLE; 
		}
		return self::TITLE;
	}

	public static function get_password_reset_url() {
		if (defined("PASSWORD_RESET_URL") && (PASSWORD_RESET_URL != "")) {
			return PASSWORD_RESET_URL;
		}
		return false;
	}

	public static function get_timezone() {
		if (defined("TIMEZONE") && (TIMEZONE != '')) {
			return TIMEZONE;
		}
		return self::TIMEZONE;

	}

	public static function get_ldap_host() {
		if (defined("LDAP_HOST")) {
			return LDAP_HOST;
		}
		return self::LDAP_HOST;
	}

	public static function get_ldap_port() {
                if (defined("LDAP_PORT") && LDAP_PORT != "") {
                        return LDAP_PORT;
                }
                return self::LDAP_PORT;
	}

        public static function get_ldap_base_dn() {
                if (defined("LDAP_BASE_DN") && LDAP_BASE_DN != "") {
                        return LDAP_BASE_DN;
                }
                return self::LDAP_BASE_DN;
        }
        public static function get_ldap_ssl() {
                if (defined("LDAP_SSL") && is_bool(LDAP_SSL)) {
                        return LDAP_SSL;
                }
                return self::LDAP_SSL;
        }

        public static function get_ldap_tls() {
                if (defined("LDAP_TLS") && is_bool(LDAP_TLS)) {
                        return LDAP_TLS;
                }
                return self::LDAP_TLS;
        }
        public static function get_ldap_bind_user() {
                if (defined("LDAP_BIND_USER") && LDAP_BIND_USER != "") {
                        return LDAP_BIND_USER;
                }
                return self::LDAP_BIND_USER;
        }
        public static function get_ldap_bind_password() {
                if (defined("LDAP_BIND_PASS") && LDAP_BIND_PASS != "") {
                        return LDAP_BIND_PASS;
                }
                return self::LDAP_BIND_PASS;
        }
        public static function get_ldap_group_dn() {
                if (defined("LDAP_GROUP") && LDAP_GROUP != "") {
                        return LDAP_GROUP;
                }
                return self::LDAP_GROUP;

        }

	public static function get_mysql_host() {
		if (defined("MYSQL_HOST")) {
			return MYSQL_HOST;
		}
		return self::MYSQL_HOST;

	}

	public static function get_mysql_user() {
		if (defined("MYSQL_USER")) {
			return MYSQL_USER;
		}
		return false;
	}

	public static function get_mysql_password() {
		if (defined("MYSQL_PASSWORD")) {
			return MYSQL_PASSWORD;
		}
		return false;
	}
	public static function get_mysql_port() {
		if (defined("MYSQL_PORT")) {
			return MYSQL_PORT;
		}
		return self::MYSQL_PORT;

	}

	public static function get_mysql_database() {
		if (defined("MYSQL_DATABASE")) {
			return MYSQL_DATABASE;
		}
		return false;
	}

	public static function get_mysql_ssl() {
		if (defined("MYSQL_SSL") && is_bool(MYSQL_SSL)) {
			return MYSQL_SSL;
		}
		return self::MYSQL_SSL;

	}

	public static function get_email() {
		if (defined("EMAIL")) {
			return EMAIL;
		}
		return false;

	}

	public static function get_upload_dir() {
		if (defined("UPLOAD_DIR")) {
			return UPLOAD_DIR;
		}
		return false;

	}

	public static function get_default_question_points() {
		if (defined('DEFAULT_QUESTION_POINTS')) {
			return DEFAULT_QUESTION_POINTS;
		}
		return false;

	}

	public static function get_default_pass_score() {
		if (defined('DEFAULT_PASS_SCORE')) {
			return DEFAULT_PASS_SCORE;
		}
		return false;

	}
}
?>
