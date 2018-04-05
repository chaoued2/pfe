<?php
class IndicatorService extends BaseService {

    private $indicatorDao;



    public function getIndicatorDao() {

        if (!($this->indicatorDao instanceof IndicatorDao)) {
            $this->indicatorDao = new IndicatorDao();
        }

        return $this->indicatorDao;
    }


    public function setIndicatorDao(IndicatorDao $indicatorDao) {
        $this->indicatorDao = $indicatorDao;
    }

    public function saveIndicator(Indicators $indicator) {


        $this->getIndicatorDao()->saveIndicator($indicator);
    }

    public function getIndicatorById($id) {
        return $this->getIndicatorDao()->getIndicatorById($id);
    }

    public function getIndicatorByName($nom) {
        return $this->getIndicatorDao()->getIndicatorByName($nom);
    }

    public function getIndicatorList() {
        return $this->getIndicatorDao()->getIndicatorList();
    }

    public function deleteIndicators($toDeleteIds) {
        return $this->getIndicatorDao()->deleteIndicators($toDeleteIds);
    }

    public function isExistingIndicatorName($indicatorName) {
        return $this->getIndicatorDao()->isExistingIndicatorName($indicatorName);
    }




}

?>