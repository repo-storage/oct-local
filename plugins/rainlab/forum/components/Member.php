<?php namespace RainLab\Forum\Components;

use Flash;
use Redirect;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\Forum\Models\Member as MemberModel;

class Member extends ComponentBase
{

    private $member = null;

    public $topicPage;
    public $topicPageIdParam;
    public $channelPage;
    public $channelPageIdParam;

    public function componentDetails()
    {
        return [
            'name'        => 'Member',
            'description' => 'Displays form member information and activity.'
        ];
    }

    public function defineProperties()
    {
        return [
            'idParam' => [
                'title'       => 'Slug param name',
                'description' => 'The URL route parameter used for looking up the forum member by their slug. A hard coded slug can also be used.',
                'default'     => ':slug',
                'type'        => 'string'
            ],
            'viewMode' => [
                'title'       => 'View mode',
                'description' => 'Manually set the view mode for the member component.',
                'type'        => 'dropdown',
                'default'     => ''
            ],
            'channelPage' => [
                'title'       => 'Channel page',
                'description' => 'Page name to use for clicking on a channel.',
                'type'        => 'dropdown',
                'group'       => 'Links',
            ],
            'channelPageIdParam' => [
                'title'       => 'Channel page param name',
                'description' => 'The expected parameter name used when creating links to the channel page.',
                'type'        => 'string',
                'default'     => ':slug',
                'group'       => 'Links',
            ],
            'topicPage' => [
                'title'       => 'Topic page',
                'description' => 'Page name to use for clicking on a conversation topic.',
                'type'        => 'dropdown',
                'group'       => 'Links',
            ],
            'topicPageIdParam' => [
                'title'       => 'Topic page param name',
                'description' => 'The expected parameter name used when creating links to the topic page.',
                'type'        => 'string',
                'default'     => ':slug',
                'group'       => 'Links',
            ],
        ];
    }

    public function getViewModeOptions()
    {
        return ['' => '- none -', 'view' => 'View', 'edit' => 'Edit'];
    }

    public function getPropertyOptions($property)
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->addCss('/plugins/rainlab/forum/assets/css/forum.css');

        $this->page['member'] = $this->getMember();
        $this->prepareVars();
    }

    public function getMember()
    {
        if ($this->member !== null)
            return $this->member;

        if (!$slug = $this->propertyOrParam('idParam'))
            $member = MemberModel::getFromUser();
        else
            $member = MemberModel::whereSlug($slug)->first();

        return $this->member = $member;
    }

    protected function prepareVars()
    {
        $this->page['canEdit'] = $this->canEdit();
        $this->page['mode'] = $this->getMode();

        /*
         * Page links
         */
        $this->topicPage = $this->page['topicPage'] = $this->property('topicPage');
        $this->topicPageIdParam = $this->page['topicPageIdParam'] = $this->property('topicPageIdParam');
        $this->channelPage = $this->page['channelPage'] = $this->property('channelPage');
        $this->channelPageIdParam = $this->page['channelPageIdParam'] = $this->property('channelPageIdParam');
    }

    public function getMode()
    {
        return $this->property('viewMode', post('mode', 'view'));
    }

    public function canEdit()
    {
        if ($this->property('viewMode') == 'view')
            return false;

        if (!$member = $this->getMember())
            return false;

        return $member->canEdit(MemberModel::getFromUser());
    }

    public function onUpdate()
    {
        try {
            if (!$this->canEdit())
                throw new ApplicationException('Permission denied.');

            $member = $this->getMember();
            if (!$member) return;

            $member->save(post());

            Flash::success(post('flash', 'Settings successfully saved!'));

            /*
             * Redirect to the intended page after successful update
             */
            $redirectUrl = post('redirect', $this->currentPageUrl([
                'slug' => $member->slug
            ]));

            return Redirect::to($redirectUrl);
        }
        catch (\Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

}