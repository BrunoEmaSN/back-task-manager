<?php

namespace App\Enums;

enum PERMISSION: string
{
  case GET_USERS = 'get.users';
  case GET_TASKS = 'get.tasks';
  case GET_COMMENTS = 'get.comments';
  case GET_FILES = 'get.files';

  case CREATE_USER = 'create.user';
  case CREATE_TASK = 'create.task';
  case CREATE_COMMENT = 'create.comment';
  case CREATE_FILE = 'create.file';

  case UPDATE_USER = 'update.user';
  case UPDATE_TASK = 'update.task';
  case UPDATE_COMMENT = 'update.comment';

  case DELETE_USER = 'delete.user';
  case DELETE_TASK = 'delete.task';
  case DELETE_COMMENT = 'delete.comment';
  case DELETE_FILE = 'delete.file';

  case DOWNLOAD_FILE = 'download.file';

  case SEND_REPORT = 'send.report';
}
