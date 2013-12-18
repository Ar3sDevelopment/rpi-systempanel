DELIMITER ;;

CREATE PROCEDURE `CheckLogin`(login_username VARCHAR(250))
BEGIN
	SELECT
		u.id,
		u.username,
		u.`password`,
		u.id_hash `hash`
	FROM
		user u
	WHERE
		u.username = login_username;
END ;;

CREATE PROCEDURE `GetHashes`(user_sid VARCHAR(250))
BEGIN
	SELECT
		`name`,
		description,
		`name` = (
			SELECT
				u.id_hash
			FROM
				user u
			INNER JOIN
				`session` s
			ON
				u.id = s.id_user
			WHERE
				s.sid = user_sid and
				expiredate >= now()
		) selected
	FROM `hash`;
END ;;

CREATE PROCEDURE `GetUserInfo`(user_sid VARCHAR(250))
BEGIN
	SELECT
		u.*
	FROM
		user u
	INNER JOIN
		`session` s
	ON
		u.id = s.id_user
	WHERE
		s.sid = user_sid AND
		expiredate >= now();
END ;;

CREATE PROCEDURE `GetWidgetFromUserWidget`(id_widget INT, user_sid VARCHAR(250))
BEGIN
	SELECT
		w.*
	FROM
		widget w
	INNER JOIN
		user_widget uw
		ON
			uw.id_widget = w.id
	INNER JOIN
		user u
		ON
			uw.id_user = u.id
	INNER JOIN
		`session` s
		ON
			s.id_user = u.id
	WHERE
		s.sid = user_sid AND uw.id = id_widget;
END ;;

CREATE PROCEDURE `GetWidgets`(IN user_sid VARCHAR(250))
BEGIN
    SELECT
		*
	FROM
		widget
	WHERE
		requireadmin = 0 OR
		(
			requireadmin = 1 AND
			(
				select
					u.admin
				FROM
					`user` u
				INNER JOIN
					`session` s
				ON
					u.id = s.id_user
				WHERE
					s.sid = user_sid
			) = 1
		);
END ;;

CREATE PROCEDURE `InsertWidget`(
	widget_title VARCHAR(250),
	widget_folder VARCHAR(250),
	widget_phpfile VARCHAR(250),
	widget_classname VARCHAR(250),
	widget_templatefile VARCHAR(250),
	widget_columns INT,
	widget_updatetime INT,
	widget_requireadmin BIT,
	widget_version INT,
	user_sid VARCHAR(250)
)
BEGIN
	INSERT INTO widget (title, folder, phpfile, class_name, templatefile, `columns`, updatetime, requireadmin, version)
	VALUES (widget_title, widget_folder, widget_phpfile, widget_classname, widget_templatefile, widget_columns, widget_updatetime, widget_requireadmin, widget_version);
END ;;

CREATE PROCEDURE `LoadSettings`(user_sid VARCHAR(250))
BEGIN
	SELECT
		uw.id uwid, uw.*, w.id wid, w.*
	FROM
		user_widget uw
	INNER JOIN
		widget w
	ON
		uw.id_widget = w.id
	INNER JOIN
		user u
	ON
		uw.id_user = u.id
	INNER JOIN
		session s
	ON
		u.id = s.id_user
	WHERE
		s.sid = user_sid AND
		expiredate >= now() AND
		(
			w.requireadmin = 0 OR
			(
				u.admin = 1 AND
				w.requireadmin = 1
			)
		)
	ORDER BY
		uw.position;
END ;;

CREATE PROCEDURE `SaveUser`(login VARCHAR(250), hashed_password VARCHAR(250), hash VARCHAR(250), user_sid VARCHAR(250))
BEGIN
	UPDATE
		user
	SET
		username = login,
		password = hashed_password,
		id_hash = hash
	WHERE
		id = (
			SELECT
				s.id_user
			FROM
				session s
			WHERE 
				sid = user_sid
			);
END ;;

CREATE PROCEDURE `SaveUserWidget`(
	widget_position INT,
	widget_id_html VARCHAR(250),
	widget_id INT,
	user_sid VARCHAR(250)
)
BEGIN
	UPDATE
		user_widget
	SET
		position = widget_position,
		id_html = widget_id_html
	WHERE
		id = widget_id AND
		id_user = (
			SELECT
				s.id_user
			FROM
				session s
			WHERE 
				sid = user_sid
			);
END ;;

CREATE PROCEDURE `SaveWidget`(widget_columns INT, widget_updatetime INT, widget_title VARCHAR(250), widget_phpfile VARCHAR(250), widget_templatefile VARCHAR(250), widget_id INT)
BEGIN
	UPDATE
		widget
	SET
		`columns` = widget_columns,
		updatettime = widget_updatettime,
		title = widget_title,
		phpfile = widget_phpfile,
		templatefile = widget_templatefile
	WHERE id = widget_id;
END ;;

CREATE PROCEDURE `ToggleWidgetState`(widget_enabled BIT, user_sid VARCHAR(250), widget_id INT)
BEGIN
	UPDATE
		user_widget uw
	SET
		uw.enabled = widget_enabled
	WHERE
		uw.id_user = (
			SELECT
				s.id_user
			FROM
				session s
			WHERE
				sid = user_sid
		) AND
		uw.id = widget_id;
END ;;

CREATE PROCEDURE `ToggleWidgetVisibility`(widget_visible BIT, user_sid VARCHAR(250), widget_id INT)
BEGIN
	UPDATE
		user_widget uw
	SET
		uw.visible = widget_visible
	WHERE
		uw.id_user = (
			SELECT
				s.id_user
			FROM
				session s
			WHERE
				sid = user_sid
		) AND
		uw.id = widget_id;
END ;;

CREATE PROCEDURE `UpdateSid`(new_sid VARCHAR(250), user_device VARCHAR(250), user_id INT)
BEGIN
	SET @session_count = (
		SELECT
			COUNT(*) session_count
		FROM
			`session`
		WHERE
			(sid = new_sid or device = user_device) and
			id_user = user_id
	);

	SET @expireDate = (SELECT DATE_ADD(CURDATE(), INTERVAL 31 DAY));
	
	IF (@session_count > 0) THEN
		UPDATE `session` SET sid = new_sid, expiredate = @expireDate where device = user_device and id_user = user_id;
	ELSE
		INSERT INTO `session` (sid, expiredate, device, id_user) VALUES (new_sid, @expireDate, user_device, user_id);
	END IF;

END ;;