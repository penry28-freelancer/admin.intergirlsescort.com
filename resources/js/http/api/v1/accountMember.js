import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class AccountMemberResource extends Resource {
  constructor() {
    super('/user/account-member');
  }
}
