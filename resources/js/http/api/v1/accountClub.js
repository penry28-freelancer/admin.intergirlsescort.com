import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class AccountClubResource extends Resource {
  constructor() {
    super('/user/account-club');
  }
}
