import Resource from '@/http/api/resource';

export default class MemberResource extends Resource {
  constructor() {
    super('/user/member');
  }
}
