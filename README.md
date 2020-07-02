# 图书管理系统
* php课设，基于[layui](https://github.com/sentsin/layui)的图书管理系统，使用了[Pear-Admin-Layui](https://github.com/Jmysy/Pear-Admin-Layui)后台模板
* [预览地址](http://demo.afirehong.cn/bm)

# 部署方法
1. 简单粗暴，直接拉取到根目录
2. 创建名为book_manage的数据库
3. 导入数据库文件
4. 管理员登录：admin, qwer1234
5. 普通用户登录：pmh, qwer1234

# 详细设计
### 有两个系统角色：
  * 管理员
  * 用户
### 主要功能：
  - 图书的增删改查
  - 用户的增删改查
  - 分类的增删改
  - 发布公告
  - 用户端和管理员端修改密码
  - 用户端发起图书借阅请求和图书归还请求
  - 管理员端对请求的确认和拒绝
