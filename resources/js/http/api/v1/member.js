import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class MemberResource extends Resource {
  constructor() {
    super('/user/member');
  }
}
