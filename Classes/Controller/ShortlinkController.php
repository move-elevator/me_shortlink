<?php

namespace MoveElevator\MeShortlink\Controller;

/**
 * @author Sascha Seyfert <sef@move-elevator.de>
 * @package me_shortlink
 * @subpackage Controller
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ShortlinkController extends \TYPO3\CMS\Extbase\MVC\Controller\ActionController {

    /**
     * @var \MoveElevator\MeShortlink\Domain\Repository\ShortlinkRepository
     * @inject
     */
    protected $shortlinkRepository;

    /**
     * action list
     *
     * @return void
     */
    public function listAction() {
	$shortlinks = $this->shortlinkRepository->findAll();
	$this->view->assign('shortlinks', $shortlinks);
    }

    /**
     * action redirect
     *
     * @return void
     */
    public function redirectAction() {
	var_dump($this->shortlinkRepository);
    }

}

?>