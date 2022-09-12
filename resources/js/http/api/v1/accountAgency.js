import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class AccountAgencyResource extends Resource {
  constructor() {
    super('/user/account-agency');
  }
}
