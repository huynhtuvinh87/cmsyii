<?php

/**
 * Posts controller Home page
 */
class PostsController extends AdminBaseController {
    /**
     * Number of items per page
     */

    const PAGE_SIZE = 50;

    /**
     * init
     */
    public function init() {
        parent::init();

        $this->breadcrumbs['Bài viết'] = array('posts/index');
        $this->pageTitle[] = 'Bài viết';
    }

    /**
     * Index action
     */
    public function actionIndex() {
        // Did we hit the submit button?
        if (isset($_POST['submit']) && $_POST['submit']) {
            // Perms
            if (!Yii::app()->user->checkAccess('op_posts_managecats')) {
                throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
            }

            if (isset($_POST['pos']) && count($_POST['pos'])) {
                foreach ($_POST['pos'] as $id => $pos) {
                    PostsCats::model()->updateByPk($id, array('position' => $pos));
                }

                // Mark
                Yii::app()->user->setFlash('success', 'Categories Reordered.');
            }
        }

        $this->breadcrumbs['Danh mục'] = '';
        $this->pageTitle[] = 'Categories';

        $this->render('index');
    }

    /**
     * Mark category as readonly or not
     */
    public function actioncatreadonly() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_managecats')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        if (isset($_GET['id']) && ( $model = PostsCats::model()->findByPk($_GET['id']) )) {
            $update = $model->readonly ? 0 : 1;
            $model->readonly = $update;
            $model->save();

            Yii::app()->user->setFlash('success', Yii::t('admintuts', 'Category status Updated.'));
            $this->redirect(array('index'));
        } else {
            Yii::app()->user->setFlash('error', Yii::t('admintuts', 'Category was not found.'));
            $this->redirect(array('index'));
        }
    }

    /**
     * Add category action
     */
    public function actionaddcategory() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_addcats')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        $model = new PostsCats;

        if (isset($_POST['PostsCats'])) {
            $model->attributes = $_POST['PostsCats'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Category Added.');
                $this->redirect(array('index'));
            }
        }

        // Adding sub?
        if (Yii::app()->request->getParam('parentid')) {
            $model->parentid = Yii::app()->request->getParam('parentid');
        }

        $roles = AuthItem::model()->findAll(array('order' => 'type DESC, name ASC'));
        $_roles = array();
        if (count($roles)) {
            foreach ($roles as $role) {
                $_roles[AuthItem::model()->types[$role->type]][$role->name] = $role->name;
            }
        }

        // Parent list
        $parents = array();
        $parentlist = PostsCats::model()->getRootCats();
        if (count($parentlist)) {
            foreach ($parentlist as $row) {
                $parents[$row->id] = $row->title;
            }
        }

        $this->breadcrumbs['Adding Category'] = '';
        $this->pageTitle[] = 'Adding Category';

        // Render
        $this->render('category_form', array('model' => $model, 'parents' => $parents, 'roles' => $_roles, 'label' => 'Adding Category'));
    }

    /**
     * Edit category action
     */
    public function actioneditcategory() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_editcats')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        if (isset($_GET['id']) && ( $model = PostsCats::model()->findByPk($_GET['id']) )) {
            if (isset($_POST['PostsCats'])) {
                $model->attributes = $_POST['PostsCats'];
                if ($model->save()) {
                    Yii::app()->user->setFlash('success',  'Category Updated.');
                    $this->redirect(array('index'));
                }
            }

            $roles = AuthItem::model()->findAll(array('order' => 'type DESC, name ASC'));
            $_roles = array();
            if (count($roles)) {
                foreach ($roles as $role) {
                    $_roles[AuthItem::model()->types[$role->type]][$role->name] = $role->name;
                }
            }

            // Parent list
            $parents = array();
            $parentlist = PostsCats::model()->getRootCats();
            if (count($parentlist)) {
                foreach ($parentlist as $row) {
                    $parents[$row->id] = $row->title;
                }
            }

            // Parse language selections and perms
            $model->language = $model->language ? explode(',', $model->language) : $model->language;

            $model->viewperms = $model->viewperms ? explode(',', $model->viewperms) : $model->viewperms;
            $model->addpostperms = $model->addpostperms ? explode(',', $model->addpostperms) : $model->addpostperms;
            $model->addcommentsperms = $model->addcommentsperms ? explode(',', $model->addcommentsperms) : $model->addcommentsperms;
            $model->addfilesperms = $model->addfilesperms ? explode(',', $model->addfilesperms) : $model->addfilesperms;
            $model->autoaddperms = $model->autoaddperms ? explode(',', $model->autoaddperms) : $model->autoaddperms;

            $this->breadcrumbs['Editing Category'] = '';
            $this->pageTitle[] =  'Editing Category';

            // Render
            $this->render('category_form', array('model' => $model, 'parents' => $parents, 'roles' => $_roles, 'label' => 'Editing Category'));
        } else {
            Yii::app()->user->setFlash('error', 'Category was not found.');
            $this->redirect(array('index'));
        }
    }

    /**
     * Delete category
     */
    public function actiondeletecategory() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_deletecats')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        if (isset($_GET['id']) && ( $model = PostsCats::model()->findByPk($_GET['id']) )) {
            // If we don't have any sub cats or posts then just go ahead and delete
            $posts = $model->posts;
            $childs = $model->childs;

            if ((!count($posts) && !count($childs))) {
                $model->delete();
                Yii::app()->user->setFlash('success', Yii::t('admintuts', 'Category Deleted.'));
                $this->redirect(array('index'));
            }

            // Remove the category we are deleting and the ones beneth it
            $removecats = array();
            $removecats[] = $model->id;
            $subcats = PostsCats::model()->getRecursiveCats($model);
            if (count($subcats)) {
                foreach ($subcats as $data) {
                    $removecats[] = $data->id;
                }
            }

            // Parent list
            $parents = array();
            $parentlist = PostsCats::model()->getRootCats();
            if (count($parentlist)) {
                foreach ($parentlist as $row) {
                    if (in_array($row->id, $removecats)) {
                        continue;
                    }
                    $parents[$row->id] = $row->title;
                }
            }

            // Did we submit the form?
            if (isset($_POST['submit']) && $_POST['submit']) {
                $movecatid = $_POST['catsmoveto'];
                $movetutid = $_POST['catsmovetuts'];

                // Category is invalid
                if ((!in_array($movecatid, array_keys($parents)) || !in_array($movetutid, array_keys($parents)))) {
                    Yii::app()->user->setFlash('error', Yii::t('admintuts', 'You must specify a valid category to move the items.'));
                } else {
                    // Update cats
                    PostsCats::model()->updateAll(array('parentid' => $movecatid), 'parentid=:parent', array(':parent' => $model->id));

                    // Update tutorial
                    Posts::model()->updateAll(array('catid' => $movetutid), 'catid=:cat', array(':cat' => $model->id));

                    // Delete cat
                    $model->delete();

                    Yii::app()->user->setFlash('success', Yii::t('admintuts', 'Category Deleted.'));
                    $this->redirect(array('index'));
                }
            }

            $this->breadcrumbs[Yii::t('admintuts', 'Delete Category')] = '';
            $this->pageTitle[] = Yii::t('admintuts', 'Delete Category');

            // Show render
            $this->render('delete_form', array('model' => $model, 'childs' => $childs, 'posts' => posts, 'parents' => $parents, 'label' => Yii::t('admintuts', 'Delete Category')));
        } else {
            //Yii::app()->user->setFlash('error', Yii::t('admintuts', 'Category was not found.'));
            $this->redirect(array('index'));
        }
    }

    /**
     * view category action
     */
    public function actionviewcategory() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_manage')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        if (isset($_GET['id']) && ( $model = PostsCats::model()->findByPk($_GET['id']) )) {
            // Did we submit the form and selected items?
            if (isset($_POST['bulkoperations']) && $_POST['bulkoperations'] != '') {
                // Perms
                if (!Yii::app()->user->checkAccess('op_news_manage')) {
                    throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
                }

                // Did we choose any values?
                if (isset($_POST['record']) && count($_POST['record'])) {
                    // What operation we would like to do?
                    switch ($_POST['bulkoperations']) {
                        case 'bulkapprove':
                            // Load records
                            $records = Posts::model()->updateByPk(array_keys($_POST['record']), array('status' => 1));
                            // Done
                            Yii::app()->user->setFlash('success', Yii::t('admintuts', '{count} tutorials approved.', array('{count}' => $records)));
                            break;

                        case 'bulkunapprove':
                            // Load records
                            $records = Posts::model()->updateByPk(array_keys($_POST['record']), array('status' => 0));
                            // Done
                            Yii::app()->user->setFlash('success', Yii::t('admintuts', '{count} tutorials Un-Approved.', array('{count}' => $records)));
                            break;

                        default:
                            // Nothing
                            break;
                    }
                }
            }

            // Load members and display
            $criteria = new CDbCriteria;
            $criteria->condition = 'catid=:cat';
            $criteria->params = array(':cat' => $model->id);

            $count = Posts::model()->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize = self::PAGE_SIZE;

            $pages->applyLimit($criteria);

            $sort = new CSort('Posts');
            $sort->defaultOrder = 'postdate DESC';
            $sort->applyOrder($criteria);

            $sort->attributes = array(
                'title' => 'title',
                'alias' => 'alias',
                'author' => 'authorid',
                'postdate' => 'postdate',
                'language' => 'language',
                'status' => 'status',
            );

            $rows = Posts::model()->with(array('author', 'lastauthor'))->findAll($criteria);

            // Add breadcrumbs and title
            $this->breadcrumbs[Yii::t('admintuts', 'Viewing Category')] = '';
            $this->pageTitle[] = Yii::t('admintuts', 'Viewing Category');

            $this->render('posts', array('model' => $model, 'count' => $count, 'rows' => $rows, 'pages' => $pages, 'sort' => $sort));
        } else {
            Yii::app()->user->setFlash('error', Yii::t('admintuts', 'Category was not found.'));
            $this->redirect(array('index'));
        }
    }

    /**
     * Add tutorial action
     */
    public function actionaddposts() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_addnews')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        $model = new Posts;

        if (isset($_POST['Posts'])) {
            $model->attributes = $_POST['Posts'];
            $image = CUploadedFile::getInstance($model, 'image');
            if (!empty($image)) {
                $type = $image->getType();
                $size = $image->getSize();
                $name = $image->getName();
                $change = $_POST['Posts']['alias'] . '.' . $image->getExtensionName();
                if ($image->saveAs('uploads/images/' . $change)) {
                    $thumb = Yii::app()->phpThumb->create('uploads/images/' . $change);
                    $thumb->resize(200, 200);
                    $thumb->save('uploads/images/200x200' . $_POST['Posts']['alias'] . '.' . $image->getExtensionName());
                }
                $model->image = $change;
            }
            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('success', 'You have successfully imported!'));
                $this->redirect(array('viewcategory', 'id' => $model->catid));
            }
        }

        // Adding by cat?
        if (Yii::app()->request->getParam('catid')) {
            $model->catid = Yii::app()->request->getParam('catid');
        }

        // cat list
        $parents = array();
        $parentlist = PostsCats::model()->getRootCats();
        if (count($parentlist)) {
            foreach ($parentlist as $row) {
                $parents[$row->id] = $row->title;
            }
        }

        $this->breadcrumbs[Yii::t('admintuts', 'Adding Tutorial')] = '';
        $this->pageTitle[] = Yii::t('admintuts', 'Adding Tutorial');

        // Render
        $this->render('posts_form', array('model' => $model, 'parents' => $parents, 'label' => Yii::t('admintuts', 'Adding Tutorial')));
    }

    /**
     * edit tutorial action
     */
    public function actioneditposts() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_editposts')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        if (isset($_GET['id']) && ( $model = Posts::model()->findByPk($_GET['id']) )) {
            if (isset($_POST['Posts'])) {

                $model->attributes = $_POST['Posts'];
                $image = CUploadedFile::getInstance($model, 'image');
                if (!empty($image)) {
                    $type = $image->getType();
                    $size = $image->getSize();
                    $name = $image->getName();
                    $change = $_POST['Posts']['alias'] . '.' . $image->getExtensionName();
                    if ($image->saveAs('uploads/images/' . $change)) {
                        $thumb = Yii::app()->phpThumb->create('uploads/images/' . $change);
                        $thumb->resize(200, 200);
                        $thumb->save('uploads/images/200x200' . $_POST['Posts']['alias'] . '.' . $image->getExtensionName());
                    }
                    $model->image = $change;
                }
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', Yii::t('admintuts', 'Tutorial Updated.'));
                    $this->redirect(array('viewcategory', 'id' => $model->catid));
                }
            }

            // cat list
            $parents = array();
            $parentlist = PostsCats::model()->getRootCats();
            if (count($parentlist)) {
                foreach ($parentlist as $row) {
                    $parents[$row->id] = $row->title;
                }
            }

            // language
            $model->language = !is_array($model->language) ? explode(',', $model->language) : $model->language;

            $this->breadcrumbs[Yii::t('admintuts', 'Editing Tutorial')] = '';
            $this->pageTitle[] = Yii::t('admintuts', 'Editing Tutorial');

            // Render
            $this->render('posts_form', array('model' => $model, 'parents' => $parents, 'label' => Yii::t('admintuts', 'Editing Tutorial')));
        } else {
            Yii::app()->user->setFlash('error', Yii::t('admintuts', 'Tutorial was not found.'));
            $this->redirect(array('index'));
        }
    }

    /**
     * Toggle tutorial status
     */
    public function actiontoggleposts() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_manage')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        if (isset($_GET['id']) && ( $model = Posts::model()->findByPk($_GET['id']) )) {
            $update = $model->status ? 0 : 1;
            $model->status = $update;
            $model->save();

            Yii::app()->user->setFlash('success', Yii::t('admintuts', 'Tutorial status Updated.'));
            $this->redirect(array('viewcategory', 'id' => $model->catid));
        } else {
            Yii::app()->user->setFlash('error', Yii::t('admintuts', 'Tutorial was not found.'));
            $this->redirect(array('index'));
        }
    }

    /**
     * Delete tutorial action
     */
    public function actiondeletenews() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_deletenews')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        if (isset($_GET['id']) && ( $model = Posts::model()->findByPk($_GET['id']) )) {
            $catid = $model->catid;

            $model->delete();

            Yii::app()->user->setFlash('success', Yii::t('admintuts', 'Tutorial Deleted.'));
            $this->redirect(array('viewcategory', 'id' => $catid));
        } else {
            $this->redirect(array('index'));
        }
    }

    /**
     * Manage comments
     */
    public function actioncomments() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_comments')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        // Did we submit the form and selected items?
        if (isset($_POST['bulkoperations']) && $_POST['bulkoperations'] != '') {
            // Did we choose any values?
            if (isset($_POST['comment']) && count($_POST['comment'])) {
                // What operation we would like to do?
                switch ($_POST['bulkoperations']) {
                    case 'bulkdelete':

                        // Perms
                        if (!Yii::app()->user->checkAccess('op_posts_deletecomments')) {
                            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
                        }

                        // Load comments and delete them
                        $comments_deleted = PostsComments::model()->deleteByPk(array_keys($_POST['comment']));
                        // Done
                        Yii::app()->user->setFlash('success', Yii::t('admintuts', '{count} comments deleted.', array('{count}' => $comments_deleted)));
                        break;

                    case 'bulkapprove':
                        // Load comments
                        $comments = PostsComments::model()->updateByPk(array_keys($_POST['comment']), array('visible' => 1));
                        // Done
                        Yii::app()->user->setFlash('success', Yii::t('admintuts', '{count} comments approved.', array('{count}' => $comments)));
                        break;

                    case 'bulkunapprove':
                        // Load comments
                        $comments = PostsComments::model()->updateByPk(array_keys($_POST['comment']), array('visible' => 0));
                        // Done
                        Yii::app()->user->setFlash('success', Yii::t('admintuts', '{count} comments Un-Approved.', array('{count}' => $comments)));
                        break;

                    default:
                        // Nothing
                        break;
                }
            }
        }

        // Grab the language data
        $criteria = new CDbCriteria;

        $count = PostsComments::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = self::PAGE_SIZE;

        $pages->applyLimit($criteria);

        $sort = new CSort('PostsComments');

        $sort->defaultOrder = 'postdate DESC';
        $sort->applyOrder($criteria);
        $sort->attributes = array(
            'tid' => 't.id',
            'authorid' => 'authorid',
            'postdate' => 'postdate',
            'visible' => 'visible',
        );

        $comments = PostsComments::model()->with(array('author'))->findAll($criteria);

        $this->breadcrumbs[Yii::t('admintuts', 'Manage Comments')] = array('posts/comments');
        $this->pageTitle[] = Yii::t('admintuts', 'Manage Comments');

        $this->render('comments', array('comments' => $comments, 'sort' => $sort, 'pages' => $pages, 'count' => $count));
    }

    /**
     * Change comment visibility status
     */
    public function actiontogglecommentstatus() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_comments')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        if (isset($_GET['id']) && ( $model = PostsComments::model()->findByPk($_GET['id']) )) {
            $model->visible = $model->visible == 1 ? 0 : 1;
            $model->save();

            Yii::app()->user->setFlash('success', Yii::t('admintuts', 'Comment Updated.'));
            $this->redirect(array('comments'));
        } else {
            $this->redirect(array('comments'));
        }
    }

    /**
     * Delete comment action
     */
    public function actiondeletecomment() {
        // Perms
        if (!Yii::app()->user->checkAccess('op_posts_deletecomments')) {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        if (isset($_GET['id']) && ( $model = PostsComments::model()->findByPk($_GET['id']) )) {
            $model->delete();

            Yii::app()->user->setFlash('success', Yii::t('admintuts', 'Comment Deleted.'));
            $this->redirect(array('comments'));
        } else {
            $this->redirect(array('comments'));
        }
    }

}