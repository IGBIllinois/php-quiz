<?php

class settings {

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
        public static function get_ldap_group() {
                if (defined("LDAP_GROUP") && LDAP_GROUP != "") {
                        return LDAP_GROUP;
                }
                return self::LDAP_GROUP;

        }

}
?>
