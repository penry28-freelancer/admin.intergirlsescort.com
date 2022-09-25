import Resource from '@/http/api/resource';

export default class PageContentResource extends Resource {
  constructor() {
    super('/utility/page-content');
  }
}
