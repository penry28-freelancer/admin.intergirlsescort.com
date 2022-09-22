<template>
  <div class="page-target">
    <table-panel>
      <template slot="title">
        <small class="text--uppercase">{{ $t('table.title.escort_review') }}</small>
      </template>

      <template slot="buttons">
        <el-button class="btn-refresh" :class="{ 'refreshing': isRefresh }" size="mini" @click="onRefresh">
          <svg-icon icon-class="refresh" />
        </el-button>
      </template>

      <template slot="filters">
        <div class="search-table">
          <el-form @submit.native.prevent="onSearch">
            <el-input
              v-model="table.listQuery.search"
              placeholder="Type something"
              prefix-icon="el-icon-search"
            />
          </el-form>
        </div>
      </template>

      <template slot="table">
        <el-table
          v-loading="table.loading"
          :data="table.list"
          :default-sort="{ prop: table.listQuery.orderBy, order: table.listQuery.ascending }"
          border
          fit
          highlight-current-row
          @sort-change="sortChange"
        >
          <el-table-column type="expand">
            <template slot-scope="{ row }">
              <div class="table-expand">
                <div class="table-expand__inner">
                  <el-tabs v-model="activeName" type="card">
                    <el-tab-pane label="Detail" name="detail">
                      <div class="inner">
                        <div class="item">
                          <div class="label">{{ $t('table.common.created_at') }}</div>
                          <div class="value d-flex align-center">
                            <svg-icon icon-class="date" />
                            <div class="value">{{ row.created_at | parseTime('{y}/{m}/{d}') }}</div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="label">{{ $t('table.common.updated_at') }}</div>
                          <div class="value d-flex align-center">
                            <svg-icon icon-class="date" />
                            <span>{{ row.updated_at | parseTime('{y}/{m}/{d}') }}</span>
                          </div>
                        </div>
                      </div>
                    </el-tab-pane>
                  </el-tabs>
                </div>
              </div>
            </template>
          </el-table-column>

          <el-table-column align="center" header-align="center" :label="$t('table.common.cardinal_number')" type="index" width="50" />

          <el-table-column :label="$t('table.common.name')" prop="name" sortable="custom" width="300">
            <template slot-scope="{ row }">
              <div class="heading">{{ row.name }}</div>
            </template>
          </el-table-column>

          <el-table-column :label="$t('table.common.email')" prop="email" sortable="custom" width="300">
            <template slot-scope="{ row }">
              <div class="heading">{{ row.email }}</div>
            </template>
          </el-table-column>

            <el-table-column :label="$t('table.common.read_at')" prop="read_at" sortable="custom" width="300">
              <template v-if="row.read_at" slot-scope="{ row }">
                <div class="value d-flex align-center">
                  <svg-icon icon-class="date" />
                  <span>{{ formatDate(row.read_at) }}</span>
                </div>
              </template>
            </el-table-column>

          <el-table-column align="center" header-align="center" :label="$t('table.common.action')">
            <template slot-scope="{ row }">
              <el-button-group>
                <el-button size="mini" @click="readContentHandler(row.message)">{{ $t('button.read_message') }}</el-button>
                <el-button size="mini" icon="el-icon-delete" @click="onDestroy(row.id)" />
                <el-tooltip class="item" effect="dark" :content="transferVerifyData(row.read_at).tooltip" placement="top">
                  <el-button size="mini" :type="transferVerifyData(row.read_at).btnColor" :icon="transferVerifyData(row.read_at).icon" @click="onToggleVerify(row.id)" />
                </el-tooltip>
              </el-button-group>
            </template>
          </el-table-column>
        </el-table>
      </template>

      <template slot="pagination">
        <pagination
          v-if="table.total > 0"
          :total="table.total"
          :page.sync="table.listQuery.page"
          :limit.sync="table.listQuery.limit"
          @pagination="getList"
        />
      </template>
    </table-panel>

    <form-service
      v-if="dialogVisibleForm"
      :is-opened="dialogVisibleForm"
      :target-id="targetId"
      @close="dialogVisibleForm = false"
      @open="dialogVisibleForm = true"
      @success="onRefresh"
    />

    <el-dialog
      :title="$t('title_dialog.content')"
      :visible.sync="dialogVisibleReviewContent"
      :before-close="closeReviewContentHandler"
      width="30%"
    >
      {{ reviewContentDialog }}
    </el-dialog>
  </div>
</template>

<script>
import TablePanel from '@/components/TablePanel';
import { CONST_PAGINATION } from '@/config/constants';
import Pagination from '@/components/Pagination';
import ContactResource from '@/http/api/v1/contact';
const contactResource = new ContactResource();
import moment from 'moment';

export default {
  name: 'ContactIndex',
  components: {
    TablePanel,
    Pagination,
  },
  layout: 'admin',
  middleware: 'auth',
  data: () => ({
    activeName: 'detail',
    table: {
      listQuery: {
        limit: CONST_PAGINATION.limit,
        page: 1,
        search: '',
        orderBy: 'updated_at',
        ascending: 'descending',
      },
      list: null,
      total: 2,
      loading: false,
    },
    dialogVisibleForm: false,
    dialogVisibleReviewContent: false,
    reviewContentDialog: '',
    isRefresh: false,
    targetId: null,
  }),
  watch: {
    '$route.query.edit': function (id) {
      if (id && !isNaN(id)) {
        this.onOpenForm(+id);
      }
    },
  },
  created() {
    this.getList();
    if (this.$route.query && this.$route.query.edit) {
      this.onOpenForm(+this.$route.query.edit);
    }
  },
  methods: {
    async getList() {
      try {
        this.table.loading = true;
        const { data } = await contactResource.list(this.table.listQuery);
        this.table.list = data.data;
        this.table.total = data.count;
        this.isRefresh = false;
        this.table.loading = false;
      } catch (e) {
        this.isRefresh = false;
        this.table.loading = false;
      }
    },
    onRefresh() {
      this.isRefresh = true;
      this.dialogVisibleForm = false;
      this.table.listQuery.page = 1;
      this.table.listQuery.search = '';
      this.getList();
    },
    onSearch() {
      this.table.listQuery.page = 1;
      this.getList();
    },
    onOpenForm(id = null) {
      if (id) {
        this.targetId = +id;
      }
      this.dialogVisibleForm = true;
    },
    sortChange(data) {
      const { prop, order } = data;
      this.table.listQuery.orderBy = prop;
      this.table.listQuery.ascending = order;
      this.getList();
    },
    onEdit(id) {
      this.$router.replace({
        query: {
          edit: id,
        },
      });
    },
    onDestroy(id) {
      this.$confirm(this.$t('confirms.permanently_delete.singular', {
        model: (this.$t('model.escort_review')).toLowerCase(),
      }), {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(async () => {
        try {
          this.table.loading = true;
          await contactResource.destroy(id);
          const idxRecord = this.table.list.findIndex(item => item.id === id);
          this.table.list.splice(idxRecord, 1);
          this.$message({
            showClose: true,
            message: this.$t('messages.permanently_deleted.singular', {
              model: (this.$t('model.escort_review')).toLowerCase(),
            }),
            type: 'success',
          });
          this.table.loading = false;
        } catch (_) {
          this.table.loading = false;
        }
      }).catch(_ => {});
    },
    onToggleVerify(id) {
      this.$confirm(this.$t('confirms.toggle_verify', {
        model: (this.$t('model.escort_review')).toLowerCase(),
      }), {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(async () => {
        try {
          this.table.loading = true;
          await contactResource.toggleVerify(id);
          const idxRecord = this.table.list.findIndex(item => item.id === id);
          const currStt = this.table.list[idxRecord].read_at;
          this.table.list[idxRecord].read_at = !currStt;
          this.$message({
            showClose: true,
            message: this.$t('messages.status_updated', {
              model: (this.$t('model.escort_review')).toLowerCase(),
            }),
            type: 'success',
          });
          this.table.loading = false;
        } catch (_) {
          this.table.loading = false;
        }
      }).catch(_ => {});
    },
    transferVerifyData(readAt) {
      if (readAt) {
        return {
          icon: 'el-icon-check',
          tooltip: 'UnVerify',
          btnColor: 'success',
        };
      }

      return {
        icon: 'el-icon-close',
        tooltip: 'Verify',
        btnColor: 'danger',
      };
    },
    readContentHandler(content) {
      this.reviewContentDialog = content;
      this.dialogVisibleReviewContent = true;
    },
    closeReviewContentHandler() {
      this.reviewContentDialog = '';
      this.dialogVisibleReviewContent = false;
    },
    formatDate(value){
      if (value) {
        return moment(String(value)).format('YYYY/MM/DD hh:mm');
      }
    },
  },
};
</script>
